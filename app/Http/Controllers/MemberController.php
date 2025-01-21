<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
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
        $registrants = Member::where('is_accepted_as_member', false)->get();
        return view('dashboard.members.registrants', [
            "title" => "Registrants",
            "registrants" => $registrants
        ]);
    }

    public function members()
    {
        $members = Member::with(['user'])->where('is_accepted_as_member', true)->get();
        $users = User::all();
        return view('dashboard.members.members', [
            "title" => "Members",
            "members" => $members,
            "users" => $users
        ]);
    }

    public function store(Request $request)
    {
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
            'immigration_law_consultant_certificate' => 'required|mimes:pdf|max:2048',
            'other_certificates' => 'required|array|max:2048',
            'other_certificates.*' => 'max:2048|mimes:pdf',
        ], [
            'other_certificates.array' => 'The certificates field must be an array of files.',
            'other_certificates.*.mimes' => 'Each certificate file must be a pdf.',
            'immigration_law_consultant_certificate.mimes' => 'Certificate file must be a pdf.',
        ]);

        $validatedData['is_member_of_other_legal_association'] = $request->input('is_member_of_other_legal_association', false);

        // Buat Registrants
        $this->memberService->createMember($validatedData);
        return redirect("/daftar-anggota")->with('success', 'Terimakasih telah mendaftar!');
    }

    public function acceptAsMember(Member $member)
    {
        $name = $member->name;

        $member->user_id = auth()->id();
        $member->is_accepted_as_member = true;
        $member->save();
        return redirect("/dashboard/members")->with('success', "$name has been accepted as a member!");
    }

    public function returnAsRegistrant(Member $member)
    {
        $name = $member->name;

        $member->user_id = auth()->id();
        $member->is_accepted_as_member = false;
        $member->save();
        return redirect("/dashboard/registrants")->with('success', "$name has been returned as a registrant!");
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
