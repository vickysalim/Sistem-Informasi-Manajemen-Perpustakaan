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
        $institutionNameData = Setting::where('key', 'institution_name')->first();
        $cityData = Setting::where('key', 'institution_city')->first();
        $principalData = Setting::where('key', 'principal')->first();
        $headLibrarianData = Setting::where('key', 'head_librarian')->first();

        $printDateData = $request->tanggalCetak;

        $bookData = Book::all();
        
        $pdf = \PDF::loadView('pages.dashboard.pdf.buku', compact('institutionNameData','cityData', 'principalData', 'headLibrarianData','printDateData','bookData'));
        return $pdf->stream();
    }
}
