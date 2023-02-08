<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        $bookData = Book::all();
        return view('pages.dashboard.buku', compact('bookData'));
    }

    public function store(Request $request) {
        // validate
        $validate = $request->validate([
            'idBuku' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required',
            'isbn' => 'required',
            'jenis' => 'required',
            'cover' => 'file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // check if id is already exist
        if(Book::where('id', $validate['idBuku'])->exists()) {
            return redirect()->route('buku')->with('danger', 'ID buku sudah ada');
        }

        try {
            // store
            $book = new Book();
            $book->id = $validate['idBuku'];
            $book->name = $validate['judul'];
            $book->author = $validate['pengarang'];
            $book->publisher = $validate['penerbit'];
            $book->year = $validate['tahun'];
            $book->isbn = $validate['isbn'];
            $book->type = $validate['jenis'];

            // upload cover
            if($request->hasFile('cover')) {
                $coverFileName = $validate['idBuku'] . '.' . $validate['cover']->getClientOriginalExtension();
                $validate['cover']->storeAs('public/cover', $coverFileName);

                $book->cover_url = $coverFileName;
            }

            // save
            $book->save();
        } catch (\Exception $e) {
            return redirect()->route('buku')->with('danger', 'Gagal menambahkan data buku');
        }
        //redirect
        return redirect()->route('buku')->with('success', 'Berhasil menambahkan data buku');
    }
}