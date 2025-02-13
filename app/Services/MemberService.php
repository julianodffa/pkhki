<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class MemberService
{
    public function createMember(array $validatedData)
    {
        // Simpan file di direktori penyimpanan dan dapatkan path file
        $ktp = $validatedData['ktp'];
        $photo = $validatedData['photo'];
        $immigrationCert = $validatedData['immigration_law_consultant_certificate'];

        $otherCertificates = $validatedData['other_certificates'];

        // Buat anggota menggunakan data yang telah divalidasi
        Member::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'] ?? null,
            'ktp' => $ktp,
            'photo' => $photo,
            'institution' => $validatedData['institution'] ?? null,
            'position' => $validatedData['position'] ?? null,
            'company_email' => $validatedData['company_email'] ?? null,
            'is_member_of_other_legal_association' => $validatedData['is_member_of_other_legal_association'] ?? false,
            'immigration_law_consultant_certificate' => $immigrationCert,
            'other_certificates' => $otherCertificates,
            'is_accepted_as_member' => $validatedData['is_accepted_as_member'] ?? false
        ]);
    }

    public function deleteMember(Member $member)
    {
        // Hapus file jika ada
        if ($member->ktp) {
            $this->deleteFile($member->ktp);
        }
        if ($member->photo) {
            $this->deleteFile($member->photo);
        }
        if ($member->immigration_law_consultant_certificate) {
            $this->deleteFile($member->immigration_law_consultant_certificate);
        }
        if ($member->other_certificates && is_array($member->other_certificates)) {
            foreach ($member->other_certificates as $cert) {
                $this->deleteFile($cert);
            }
        }
        // Hapus dari database
        $member->delete();
    }

    protected function storeFile($file, $folder)
    {
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs("members/$folder", $filename, 'local');
        return $path;
    }

    public function storeEncryptFile($file, $folder)
    {
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $fileContent = file_get_contents($file->getRealPath());

        // Enkripsi isi file
        $encryptedContent = Crypt::encrypt($fileContent);
        // Simpan file di storage/app/uploads
        Storage::put("members/$folder/{$filename}", $encryptedContent);
        $path = "members/$folder/{$filename}";
        return $path;
    }

    public function getFileContent($folder, $filename)
    {
        $filePath = "members/$folder/$filename";

        if (!Storage::exists($filePath)) {
            return response('', 200);
        }

        $encryptedContent = Storage::get($filePath);
        $mimeType = mime_content_type(storage_path("app/$filePath"));

        $decryptFolders = ['ktp', 'photo', 'ilc_certificate', 'other_certificate'];

        if (in_array($folder, $decryptFolders)) {
            $decryptedContent = Crypt::decrypt($encryptedContent);

            if (in_array($folder, ['ilc_certificate', 'other_certificate'])) {
                return response($decryptedContent)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
            }

            return response($decryptedContent, 200)->header('Content-Type', $mimeType);
        }

        return response()->file(Storage::path($filePath));
    }


    protected function deleteFile($filePath)
    {
        // Hapus file dari penyimpanan
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}
