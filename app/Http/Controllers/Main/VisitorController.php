<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function index()
    {
        return view('pages.main.pengunjung');
    }

    public function store(Request $request) {
        // validate
        $validate = $request->validate([
            'nomorAnggota' => 'required'
        ]);

        // check if id not exists
        if(!Member::where('id', $validate['nomorAnggota'])->exists()) {
            return redirect()->route('pengunjung')->with('danger', 'Nomor anggota '. $request['nomorAnggota'] .' tidak ditemukan');
        }

        // check if status is not active
        if (Member::where('id', $validate['nomorAnggota'])->first()->status == 'Non-Aktif') {
            return redirect()->route('pengunjung')->with('danger', 'Nomor anggota '. $request['nomorAnggota'] .' sudah tidak aktif');
        }

        try {
            // store
            $visitor = new Visitor();
            $visitor->member_id = $validate['nomorAnggota'];

            // save
            $visitor->save();
        } catch (\Exception $e) {
            return redirect()->route('pengunjung')->with('danger', 'Terjadi kesalahan. Silakan coba lagi.');
        }

        // redirect
        return redirect()->route('pengunjung')->with('success', 'Selamat datang '. $visitor->Member->name);
    }
}
