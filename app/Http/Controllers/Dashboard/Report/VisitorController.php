<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function index() {
        return view('pages.dashboard.laporan.pengunjung');
    }

    public function getReport(Request $request) {
        // validate
        $validate = $request->validate([
            'tanggalCetak' => 'required',
            'thnAjaranAwal' => 'required',
            'thnAjaranAkhir' => 'required'
        ]);

        // get data from settings
        $institutionNameData = Setting::where('key', 'institution_name')->first();
        $cityData = Setting::where('key', 'institution_city')->first();
        $principalData = Setting::where('key', 'principal')->first();
        $headLibrarianData = Setting::where('key', 'head_librarian')->first();

        // get data from form
        $printDateData = $validate['tanggalCetak'];
        $startDate = $validate['thnAjaranAwal'].'-07-01';
        $endDate = $validate['thnAjaranAkhir'].'-06-30';

        // get record from visitor
        $visitorData = Visitor::whereBetween('created_at', [$startDate, $endDate])->get();
        
        // get top 10 visitor
        $topVisitorData = Visitor::select('member_id', \DB::raw('count(*) as total'))->whereBetween('created_at', [$startDate, $endDate])->groupBy('member_id')->orderBy('total', 'desc')->limit(10)->get();

        // get statistic from visitor
        $visitingCountData = Visitor::whereBetween('created_at', [$startDate, $endDate])->count();
        $visitorCountData = Visitor::select('member_id', \DB::raw('count(*) as total'))->whereBetween('created_at', [$startDate, $endDate])->groupBy('member_id')->orderBy('total', 'desc')->get()->count();

        // redirect
        $pdf = \PDF::loadView('pages.dashboard.pdf.pengunjung', compact('institutionNameData','cityData', 'principalData', 'headLibrarianData','printDateData','startDate','endDate','visitorData', 'topVisitorData', 'visitingCountData', 'visitorCountData'));
        return $pdf->stream('laporan_pengunjung_'.md5(time()).'.pdf');
    }
}
