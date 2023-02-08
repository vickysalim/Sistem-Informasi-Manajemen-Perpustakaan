<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

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

    public function update(Request $request, Book $book) {
        // validate
        $validate = $request->validate([
            'idBuku' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required',
            'isbn' => 'required',
            'jenis' => 'required',
            'updateCover' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // check if id is already exist & check if id is not same
        if(Book::where('id', $validate['idBuku'])->exists() && $validate['idBuku'] != $book->id) {
            return redirect()->route('buku')->with('danger', 'ID buku sudah ada');
        }

        try {
            // get current cover url
            $getCurrentCoverUrl = Book::where('id', $book->id)->first()->cover_url;
            
            // upload cover
            if($request->hasFile('updateCover')) {
                // delete old cover
                if($getCurrentCoverUrl != "" & file_exists(storage_path('app\\public\\cover\\' . $getCurrentCoverUrl))) {
                    File::delete(storage_path('app\\public\\cover\\' . $getCurrentCoverUrl));
                }
                
                $coverFileName = $validate['idBuku'] . '.' . $validate['updateCover']->getClientOriginalExtension();
                $validate['updateCover']->storeAs('public/cover', $coverFileName);
                
                Book::where('id', $book->id)
                ->update([
                    'cover_url' => $coverFileName
                ]);
            } else {
                if($getCurrentCoverUrl != "") {
                    $getCurrentCoverUrlExtension = explode('.', $getCurrentCoverUrl)[1];

                    $coverFileName = $validate['idBuku'] . '.' . $getCurrentCoverUrlExtension;
                    $coverFile = storage_path('app/public/cover/' . $getCurrentCoverUrl);
                    $newCoverFile = storage_path('app/public/cover/' . $coverFileName);
    
                    rename($coverFile, $newCoverFile);
    
                    Book::where('id', $book->id)
                        ->update([
                            'cover_url' => $coverFileName
                        ]);
                }
            }

            // update
            Book::where('id', $book->id)
                ->update([
                    'id' => $validate['idBuku'],
                    'name' => $validate['judul'],
                    'author' => $validate['pengarang'],
                    'publisher' => $validate['penerbit'],
                    'year' => $validate['tahun'],
                    'isbn' => $validate['isbn'],
                    'type' => $validate['jenis']
                ]);
        } catch (\Exception $e) {
            return redirect()->route('buku')->with('danger', 'Gagal mengubah data buku ' . $book->id . ' (ID: ' . $book->id . ')');
        }

        // redirect
        return redirect()->route('buku')->with('success', 'Berhasil mengubah data buku ' . $book->id . ' (ID: ' . $book->id . ')');
    }

    public function destroy(Request $request, Book $book) {
        try {
            // get cover file name
            $coverFileName = Book::where('id', $book->id)->first()->cover_url;

            if($coverFileName != "" & file_exists(storage_path('app\\public\\cover\\' . $coverFileName))) {
                File::delete(storage_path('app\\public\\cover\\' . $coverFileName));
            }

            // delete
            Book::where('id', $book->id)->delete();
        } catch (\Exception $e) {
            return redirect()->route('buku')->with('danger', 'Gagal menghapus data buku ' . $book->name . ' (ID: ' . $book->id .')');
        }

        // redirect
        return redirect()->route('buku')->with('success', 'Berhasil menghapus data buku ' . $book->name . ' (ID: ' . $book->id .')');
    }
}