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
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Registrants', 'url' => url("/dashboard/registrants"), 'active' => true]
        ];

        $registrants = Member::latest()->where('is_accepted_as_member', false)->paginate(50);
        return view('dashboard.members.registrants', [
            "title" => "Registrants",
            'breadcrumbs' => $breadcrumbs,
            "registrants" => $registrants,
            "countRegistrants" => Member::where('is_accepted_as_member', false)->count(),
            "countNewRegistrants" => Member::where('checked', false)->count(),
            "javascript" => [
                "/assets/js/sweetalert/sweetalert.js",
                "/assets/js/sweetalert/sweetalert-trigger.js"
            ]
        ]);
    }

    public function members()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => 'Members', 'url' => url("/dashboard/members"), 'active' => true]
        ];

        $members = Member::latest()->with(['user'])->where('is_accepted_as_member', true)->paginate(50);
        return view('dashboard.members.members', [
            "title" => "Members",
            'breadcrumbs' => $breadcrumbs,
            "members" => $members,
            "countMembers" => Member::where('is_accepted_as_member', true)->count(),
            "javascript" => [
                "/assets/js/sweetalert/sweetalert.js",
                "/assets/js/sweetalert/sweetalert-trigger.js"
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:members,email',
            'address' => 'required|string',
            'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'institution' => 'required|string',
            'position' => 'required|string',
            'company_email' => 'required|email',
            'is_member_of_other_legal_association' => 'boolean',
            'immigration_law_consultant_certificate' => 'required|mimes:pdf|max:2048',
            'other_certificates' => 'array|max:2048',
            'other_certificates.*' => 'max:2048|mimes:pdf',
        ], [
            'ktp.max' => 'Maximum file size is 2MB.',
            'photo.max' => 'Maximum file size is 2MB.',
            'immigration_law_consultant_certificate.max' => 'Maximum file size is 2MB.',
            'immigration_law_consultant_certificate.mimes' => 'Certificate file must be a pdf.',
            'other_certificates.array' => 'The certificates field must be an array of files.',
            'other_certificates.*.mimes' => 'Each certificate file must be a pdf.',
            'other_certificates.*.max' => 'The maximum size of each file is 2 MB.',
        ]);

        $validatedData['is_member_of_other_legal_association'] = $request->input('is_member_of_other_legal_association', false);

        $this->memberService->createMember($validatedData);
        return redirect("/daftar-anggota")->with('success', 'Terimakasih telah mendaftar!');
    }

    public function acceptAsMember(Member $member)
    {
        $name = $member->name;
        $member->user_id = auth()->id();
        $member->is_accepted_as_member = true;
        $member->save();

        return redirect("/dashboard/registrants")->with('success', "$name has been accepted as a member!");
    }

    public function returnAsRegistrant(Member $member)
    {
        $name = $member->name;
        $member->user_id = auth()->id();
        $member->is_accepted_as_member = false;
        $member->save();

        return redirect("/dashboard/members")->with('success', "$name has been returned as a registrant!");
    }

    public function show(Member $member)
    {
        $member->update(['checked' => true]);
        if ($member->is_accepted_as_member == true) {
            $status = ['Members', 'members'];
        } else {
            $status = ['Registrants', 'registrants'];
        }

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => url('/dashboard'), 'active' => false],
            ['label' => $status[0], 'url' => url("/dashboard/$status[1]"), 'active' => false],
            ['label' => $member->name, 'url' => '', 'active' => true]
        ];

        return view("dashboard.members.show", [
            "title" => "Registrant",
            'breadcrumbs' => $breadcrumbs,
            "registrant" => $member
        ]);
    }

    public function destroy(Member $member)
    {
        $this->memberService->deleteMember($member);
        return redirect('/dashboard/registrants')->with('success', 'Registrant successfully deleted.');
    }
}
