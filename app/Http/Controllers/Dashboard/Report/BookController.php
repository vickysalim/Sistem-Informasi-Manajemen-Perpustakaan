<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        $bookData = Book::all();
        return view('pages.dashboard.laporan.buku', compact('bookData'));
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

        // get record from book
        $bookData = Book::all();

        // get statistic from book
        $bookCountData = Book::all()->count();
        $loanedBookCountData = Book::where('status', 'Sedang Dipinjam')->count();
        $availableBookCountData = Book::where('status', 'Tersedia')->count();

        // redirect
        $pdf = \PDF::loadView('pages.dashboard.pdf.buku', compact('institutionNameData','cityData', 'principalData', 'headLibrarianData','printDateData','bookData', 'bookCountData', 'loanedBookCountData', 'availableBookCountData'));
        return $pdf->stream();
    }
}
