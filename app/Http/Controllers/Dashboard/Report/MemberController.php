<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\Member;

class MemberController extends Controller
{
    public function index() {
        return view('pages.dashboard.laporan.anggota');
    }

    public function getReport(Request $request) {
        // validate
        $validate = $request->validate([
            'tanggalCetak' => 'required'
        ]);

        // get data from settings
        $institutionNameData = Setting::where('key', 'institution_name')->first();
        $cityData = Setting::where('key', 'institution_city')->first();
        $principalData = Setting::where('key', 'principal')->first();
        $headLibrarianData = Setting::where('key', 'head_librarian')->first();

        // get data from form
        $printDateData = $validate['tanggalCetak'];

        // get record from member
        $memberData = Member::all()->sortBy("status");

        // get statistic from member
        $memberCountData = Member::all()->count();
        $activeMemberCountData = Member::where('status', 'Aktif')->count();
        $inactiveMemberCountData = Member::where('status', 'Non-Aktif')->count();

        // redirect
        $pdf = \PDF::loadView('pages.dashboard.pdf.anggota', compact('institutionNameData','cityData', 'principalData', 'headLibrarianData','printDateData','memberData', 'memberCountData', 'activeMemberCountData', 'inactiveMemberCountData'));
        return $pdf->stream('laporan_anggota_'.md5(time()).'.pdf');
    }
}
