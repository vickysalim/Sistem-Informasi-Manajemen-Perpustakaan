<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Member;

class MemberController extends Controller
{
    public function index() {
        $memberData = Member::all();
        return view('pages.dashboard.anggota', compact('memberData'));
    }
}
