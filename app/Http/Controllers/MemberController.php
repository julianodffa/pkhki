<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Services\MemberService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function registrants()
    {
        $registrants = Member::all();
        return view('dashboard.members.registrants', [
            "title" => "Registrants",
            "registrants" => $registrants
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        // Validasi
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:members,email',
            'address' => 'required|string',
            'ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'institution' => 'required|string',
            'position' => 'required|string',
            'company_email' => 'required|email',
            'is_member_of_other_legal_association' => 'boolean',
            'immigration_law_consultant_certificate' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'other_certificates' => 'required|array|max:2048',
            'other_certificates.*' => 'max:2048',
        ], [
            'other_certificates.array' => 'The certificates field must be an array of files.',
            'other_certificates.*.max' => 'Each certificate file must not exceed 2MB.',
        ]);

        $validatedData['is_member_of_other_legal_association'] = $request->input('is_member_of_other_legal_association', false);

        // Buat Registrants
        $this->memberService->createMember($validatedData);
        return redirect("/home/daftar")->with('success', 'Terimakasih telah mendaftar!');
    }

    public function show(Member $member)
    {
        return view("dashboard.members.show", [
            "title" => "Registrant",
            "registrant" => $member
        ]);
    }

    public function destroy(Member $member)
    {
        $this->memberService->deleteMember($member);

        return redirect('/dashboard/registrants')->with('success', 'Member deleted successfully.');
    }
}
