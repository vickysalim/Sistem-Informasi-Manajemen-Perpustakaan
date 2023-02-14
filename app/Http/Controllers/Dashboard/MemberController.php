<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\MembersImport;

use App\Models\Member;

class MemberController extends Controller
{
    public function index() {
        $memberData = Member::all();
        return view('pages.dashboard.anggota', compact('memberData'));
    }
    
    public function store(Request $request) {
        // validate
        $validate = $request->validate([
            'idAnggota' => 'required',
            'nama' => 'required',
            'status' => 'required'
        ]);

        // check if id is already exist
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

    public function import(Request $request) {
        // validate
		$validate = $request->validate([
			'excel' => 'required|mimes:xls,xlsx'
		]);
        
        // get file extension
        $fileExtension = $validate['excel']->getClientOriginalExtension();

        // generate random file name
        $fileName = Str::random(32) . '.' . $fileExtension;

        try {
            // store file in temporary directory
            $validate['excel']->storeAs('public/temp', $fileName);

            // import data from excel
            Excel::import(new MembersImport, storage_path('app\\public\\temp\\' . $fileName));

            // delete temporary file
            File::delete(storage_path('app\\public\\temp\\' . $fileName));
        } catch (\Illuminate\Database\QueryException $qE) {
            return redirect()->route('anggota')->with('danger', 'Gagal mengimpor data anggota, pastikan ID anggota tidak pernah digunakan sebelumnya');
        }
        catch (\Exception $e) {
            return redirect()->route('anggota')->with('danger', 'Gagal mengimpor data anggota' . $e);
        }

        // redirect
        return redirect()->route('anggota')->with('success', 'Berhasil mengimpor data anggota');
    }

    public function switchStatus(Request $request, Member $member) {
        // check status
        if($member->status == 'Aktif') {
            $newStatus = 'Non-Aktif';
        } else if($member->status == 'Non-Aktif') {
            $newStatus = 'Aktif';
        } else {
            return redirect()->route('anggota')->with('danger', 'Gagal mengubah status anggota ' . $member->name . ' (ID: ' . $member->id .')');
        }

        // switch status
        Member::where('id', $member->id)
            ->update([
                'status' => $newStatus
            ]);

        // redirect
        return redirect()->route('anggota')->with('success', 'Berhasil mengubah status anggota ' . $member->name . ' (ID: ' . $member->id .') menjadi ' . $newStatus);
    }

    public function update(Request $request, Member $member) {
        // validate
        $validate = $request->validate([
            'idAnggota' => 'required',
            'nama' => 'required'
        ]);

        // check if id is already exist & check if id is not the same
        if(Member::where('id', $validate['idAnggota'])->exists() && $validate['idAnggota'] != $member->id) {
            return redirect()->route('anggota')->with('danger', 'ID anggota sudah ada');
        }
        
        try {
            // update
            Member::where('id', $member->id)
                ->update([
                    'id' => $validate['idAnggota'],
                    'name' => $validate['nama']
                ]);
        } catch (\Exception $e) {
            return redirect()->route('anggota')->with('danger', 'Gagal mengubah data anggota ' . $member->name . ' (ID: ' . $member->id .')');
        }

        // redirect
        return redirect()->route('anggota')->with('success', 'Berhasil mengubah data anggota ' . $member->name . ' (ID: ' . $member->id .')');
    }

    public function destroy(Request $request, Member $member) {
        try {
            // delete
            Member::where('id', $member->id)->delete();
        } catch (\Exception $e) {
            return redirect()->route('anggota')->with('danger', 'Gagal menghapus data anggota ' . $member->name . ' (ID: ' . $member->id .')');
        }

        // redirect
        return redirect()->route('anggota')->with('success', 'Berhasil menghapus data anggota ' . $member->name . ' (ID: ' . $member->id .')');
    }
}
