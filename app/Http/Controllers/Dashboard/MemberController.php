<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Member;

class MemberController extends Controller
{
    public function index() {
        $memberData = Member::all();
        return view('pages.dashboard.anggota', compact('memberData'));
    }
    
    public function store(Request $request) {
        // validate idBuku, name, status
        $validate = $request->validate([
            'idAnggota' => 'required',
            'nama' => 'required',
            'status' => 'required'
        ]);

        // check if idAnggota is already exist
        if(Member::where('id', $validate['idAnggota'])->exists()) {
            return redirect()->route('anggota')->with('danger', 'ID anggota sudah ada');
        }
        
        try {
            // store
            $member = new Member();
            $member->id = $validate['idAnggota'];
            $member->name = $validate['nama'];
            $member->status = $validate['status'];
    
            // save
            $member->save();
        } catch (\Exception $e) {
            return redirect()->route('anggota')->with('danger', 'Gagal menambahkan data anggota');
        }

        // redirect
        return redirect()->route('anggota')->with('success', 'Berhasil menambahkan data anggota');
    }
}
