<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Circulation;
use App\Models\Setting;

class DashboardCirculationController extends Controller
{
    public function index() {
        $fineData = Setting::where('key', 'fine')->first();
        $circulationData = Circulation::all()->where('status', 'Berjalan');
        return view('pages.dashboard.sirkulasi', compact('fineData', 'circulationData'));
    }

    public function store(Request $request) {
        // get loan duration data
        $loanDurationData = Setting::where('key', 'loan_duration')->first();
        $addDurationFormat = '+' . $loanDurationData->value . 'days';

        // check weekend
        if (date('D', strtotime($addDurationFormat)) == 'Sat') {
            $addDurationFormat = '+' . $loanDurationData->value + 2 . 'days';
        } else if (date('D', strtotime($addDurationFormat)) == 'Sun') {
            $addDurationFormat = '+' . $loanDurationData->value + 1 . 'days';
        }
        
        // set return date
        $returnDate = date('Y-m-d', strtotime($addDurationFormat));

        // validate
        $validate = $request->validate([
            'idAnggota' => 'required',
            'idBuku' => 'required'
        ]);

        // store
        $circulation = new Circulation();
        $circulation->member_id = $validate['idAnggota'];
        $circulation->book_id = $validate['idBuku'];
        $circulation->loan_date = date('Y-m-d');
        $circulation->latest_extend_date = date('Y-m-d');
        $circulation->return_date = $returnDate;
        
        // save
        $circulation->save();

        // redirect
        return redirect()->route('sirkulasi')->with('success', 'Berhasil menambahkan data sirkulasi');
    }

    public function extend(Request $request, Circulation $circulation) {
        // get current return date
        $currentReturnDate = $circulation->return_date;

        // get loan duration data
        $loanDurationData = Setting::where('key', 'loan_duration')->first();
        $addDurationFormat = $currentReturnDate . '+' . $loanDurationData->value . 'days';
        
        // check weekend
        if (date('D', strtotime($addDurationFormat)) == 'Sat') {
            $addDurationFormat = $currentReturnDate . '+' . $loanDurationData->value + 2 . 'days';
        } else if (date('D', strtotime($addDurationFormat)) == 'Sun') {
            $addDurationFormat = $currentReturnDate . '+' . $loanDurationData->value + 1 . 'days';
        }
        
        // set return date
        $returnDate = date('Y-m-d', strtotime($addDurationFormat));

        // extend
        Circulation::where('id', $circulation->id)
            ->update([
                'return_date' => $returnDate
            ]);

        // redirect
        return redirect()->route('sirkulasi')->with('success', 'Berhasil menambah durasi peminjaman buku ' . $circulation->Book->name . ' oleh ' . $circulation->Member->name);
    }

    public function return(Request $request, Circulation $circulation) {

    }
}
