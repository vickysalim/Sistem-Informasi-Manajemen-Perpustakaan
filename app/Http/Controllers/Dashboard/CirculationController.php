<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Circulation;
use App\Models\Setting;
use App\Models\Member;
use App\Models\Book;

class CirculationController extends Controller
{
    public function index() {
        $fineData = Setting::where('key', 'fine')->first();
        $extendLimitData = Setting::where('key', 'extend_limit')->first();
        $circulationData = Circulation::all()->where('status', 'Berjalan');
        return view('pages.dashboard.sirkulasi', compact('fineData', 'extendLimitData', 'circulationData'));
    }

    public function store(Request $request) {
        // validate
        $validate = $request->validate([
            'idAnggota' => 'required',
            'idBuku' => 'required'
        ]);
        
        // if member id is not exist in database then return error
        if (!Member::where('id', $validate['idAnggota'])->exists()) {
            return redirect()->route('sirkulasi')->with('danger', 'ID anggota ' . $validate['idAnggota'] . ' tidak ditemukan');
        }

        // if book id is not exist in database then return error
        if (!Book::where('id', $validate['idBuku'])->exists()) {
            return redirect()->route('sirkulasi')->with('danger', 'ID buku ' . $validate['idBuku'] . ' tidak ditemukan');
        }

        // if member status is inactive then return error
        if (Member::where('id', $validate['idAnggota'])->first()->status == 'Non-Aktif') {
            return redirect()->route('sirkulasi')->with('danger', 'Anggota dengan ID ' . $validate['idAnggota'] . ' tidak dapat meminjam buku karena statusnya non-aktif');
        }

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

        try {
            // store
            $circulation = new Circulation();
            $circulation->member_id = $validate['idAnggota'];
            $circulation->book_id = $validate['idBuku'];
            $circulation->loan_date = date('Y-m-d');
            $circulation->latest_extend_date = date('Y-m-d');
            $circulation->return_date = $returnDate;
            
            // save
            $circulation->save();
        } catch (\Exception $e) {
            return redirect()->route('sirkulasi')->with('danger', 'Gagal menambahkan data sirkulasi');
        }

        // redirect
        return redirect()->route('sirkulasi')->with('success', 'Berhasil menambahkan data sirkulasi');
    }

    public function extend(Request $request, Circulation $circulation) {
        // if circulation status is finished, return error
        if ($circulation->status != 'Berjalan') {
            return redirect()->route('sirkulasi')->with('danger', 'Status peminjaman tidak dapat diperpanjang karena sudah dikembalikan pada tanggal ' . $circulation->return_date);
        }

        // get extend limit data
        $currentExtendCount = $circulation->extend_count;
        $extendLimitData = Setting::where('key', 'extend_limit')->first();

        // if current extend count is equal or more than extend limit, return error
        if ($currentExtendCount >= $extendLimitData->value) {
            return redirect()->route('sirkulasi')->with('danger', 'Peminjaman buku ' . $circulation->Book->name . ' oleh ' . $circulation->Member->name . ' sudah melebihi batas perpanjangan');
        }

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

        // get fine data
        $currentFineSum = $circulation->fine_sum;
        $fineData = Setting::where('key', 'fine')->first();

        // set fine
        $diff = date_diff(date_create(date('Y-m-d')), date_create($circulation->return_date));
        if($diff->format('%R%a') < 0) {
            $totalFine = abs($diff->format('%R%a') * $fineData->value);
        } else {
            $totalFine = 0;
        }

        // extend
        Circulation::where('id', $circulation->id)
            ->update([
                'return_date' => $returnDate,
                'extend_count' => $currentExtendCount + 1,
                'latest_extend_date' => date('Y-m-d'),
                'fine_sum' => $currentFineSum + $totalFine
            ]);

        // redirect
        return redirect()->route('sirkulasi')->with('success', 'Berhasil menambah durasi peminjaman buku ' . $circulation->Book->name . ' oleh ' . $circulation->Member->name);
    }

    public function return(Request $request, Circulation $circulation) {
        // if circulation status is finished, return error
        if ($circulation->status != 'Berjalan') {
            return redirect()->route('sirkulasi')->with('danger', 'Status peminjaman tidak dapat diperpanjang karena sudah dikembalikan pada tanggal ' . $circulation->return_date);
        }
        
        // get fine data
        $currentFineSum = $circulation->fine_sum;
        $fineData = Setting::where('key', 'fine')->first();

        // set fine
        $diff = date_diff(date_create(date('Y-m-d')), date_create($circulation->return_date));
        if($diff->format('%R%a') < 0) {
            $totalFine = abs($diff->format('%R%a') * $fineData->value);
        } else {
            $totalFine = 0;
        }

        // return
        Circulation::where('id', $circulation->id)
            ->update([
                'fine_sum' => $currentFineSum + $totalFine,
                'return_date' => date('Y-m-d'),
                'status' => 'Selesai'
            ]);

        // redirect
        return redirect()->route('sirkulasi')->with('success', 'Buku ' . $circulation->Book->name . ' oleh ' . $circulation->Member->name . ' telah berhasil dikembalikan');
    }
}
