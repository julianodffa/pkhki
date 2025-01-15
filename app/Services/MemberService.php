<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Str;


class MemberService
{
    public function createMember(array $validatedData)
    {
        $ktp = isset($validatedData['ktp']) ? $this->storeFile($validatedData['ktp'], 'assets/members/ktp') : null;
        $photo = isset($validatedData['photo']) ? $this->storeFile($validatedData['photo'], 'assets/members/photo') : null;
        $immigrationCert = isset($validatedData['immigration_law_consultant_certificate']) ? $this->storeFile($validatedData['immigration_law_consultant_certificate'], 'assets/members/ilc_certificate') : null;
        $otherCertificates = isset($validatedData['other_certificates']) ? array_map(function ($file) {
            return $this->storeFile($file, 'assets/members/other_certificate');
        }, $validatedData['other_certificates']) : [];

        // Create the member using the validated data
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
            'is_accepted_as_member' => $validatedData['is_accepted_as_member'] ?? false,
        ]);
    }

    public function deleteMember(Member $member)
    {
        // Delete files if they exist
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

        // Delete the member record
        $member->delete();
    }

    protected function storeFile($file, $folder)
    {
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $path = public_path($folder);

        if (!is_dir($path)) {
            mkdir($path, 0755, true); // Create the directory if it doesn't exist
        }

        $file->move($path, $filename);

        return "$folder/$filename";
    }
    protected function deleteFile($filePath)
    {
        $fullPath = public_path($filePath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
