<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MemberService
{
    public function createMember(array $validatedData)
    {
        // Simpan file di direktori penyimpanan dan dapatkan path file
        $ktp = isset($validatedData['ktp']) ? $this->storeFile($validatedData['ktp'], 'ktp') : null;
        $photo = isset($validatedData['photo']) ? $this->storeFile($validatedData['photo'], 'photo') : null;
        $immigrationCert = isset($validatedData['immigration_law_consultant_certificate']) ? $this->storeFile($validatedData['immigration_law_consultant_certificate'], 'ilc_certificate') : null;
        $otherCertificates = isset($validatedData['other_certificates']) ? array_map(function ($file) {
            return $this->storeFile($file, 'other_certificate');
        }, $validatedData['other_certificates']) : [];

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
        // Hasilkan nama file yang unik
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        // Simpan file di folder penyimpanan
        $path = $file->storeAs("members/$folder", $filename, 'local'); // 'lokal' menunjuk ke penyimpanan/aplikasi
        return $path; // kembalikan relative path
    }

    protected function deleteFile($filePath)
    {
        // Hapus file dari penyimpanan
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}
