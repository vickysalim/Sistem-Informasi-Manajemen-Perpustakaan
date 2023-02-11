<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\Circulation;

class TransactionController extends Controller
{
    public function index() {
        return view('pages.dashboard.laporan.transaksi');
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
        
        // get record from circulation
        $circulationData = Circulation::whereBetween('loan_date', [$startDate, $endDate])->get();
        
        // get statistic from circulation
        $loaneeCountData = Circulation::selectRaw('member_id, count(*) as count')->whereBetween('loan_date', [$startDate, $endDate])->groupBy('member_id')->get()->count();
        $transactionCountData = Circulation::whereBetween('loan_date', [$startDate, $endDate])->count();
        $fineSumData = Circulation::whereBetween('loan_date', [$startDate, $endDate])->sum('fine_sum');
        
        // get average loan per workdays
        $loanAverageData = $transactionCountData / 261;

        // redirect
        $pdf = \PDF::loadView('pages.dashboard.pdf.transaksi', compact('institutionNameData','cityData', 'principalData', 'headLibrarianData','printDateData','startDate', 'endDate', 'circulationData', 'loaneeCountData', 'transactionCountData', 'fineSumData', 'loanAverageData'));
        return $pdf->stream('laporan_transaksi_'.md5(time()).'.pdf');
    }
}
