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
        $institutionNameData = Setting::where('key', 'institution_name')->first();
        $cityData = Setting::where('key', 'institution_city')->first();
        $principalData = Setting::where('key', 'principal')->first();
        $headLibrarianData = Setting::where('key', 'head_librarian')->first();

        $printDateData = $request->tanggalCetak;
        $startDate = $request->thnAjaranAwal.'-07-01';
        $endDate = $request->thnAjaranAkhir.'-06-30';
        
        $circulationData = Circulation::whereBetween('loan_date', [$startDate, $endDate])->get();
        
        $loaneeCountData = Circulation::selectRaw('member_id, count(*) as count')->whereBetween('loan_date', [$startDate, $endDate])->groupBy('member_id')->get()->count();
        $transactionCountData = Circulation::whereBetween('loan_date', [$startDate, $endDate])->count();
        $fineSumData = Circulation::whereBetween('loan_date', [$startDate, $endDate])->sum('fine_sum');
        
        $loanAverageData = $transactionCountData / 261;

        $pdf = \PDF::loadView('pages.dashboard.pdf.transaksi', compact('institutionNameData','cityData', 'principalData', 'headLibrarianData','printDateData','startDate', 'endDate', 'circulationData', 'loaneeCountData', 'transactionCountData', 'fineSumData', 'loanAverageData'));
        return $pdf->stream();
    }
}
