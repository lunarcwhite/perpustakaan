<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Jurusan;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Excel;
use App\Imports\ImportAnggota;

class KelolaAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['anggotas'] = Anggota::orderBy('nama_anggota')->get();
        $data['jurusans'] = Jurusan::orderBy('nama_jurusan')->get();
        $data['tahunAjarans'] = TahunAjaran::orderBy('tahun_ajaran')->get();
        return view('admin.anggota.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_anggota' => 'required',
            'jurusan_id' => 'required',
            'tahun_ajaran_id' => 'required'
        ]);

        try {
            $id_user = User::where('role_id',2)->latest('id')->first();
            $id = $id_user->id + 1;
            $no_anggota = Str::random(10);
            $user = [
                'id' => $id,
                'username' => $no_anggota,
                'email' => null,
                'password' => bcrypt('gbghfd65#2w4512345sdghgh^$^'),
                'role_id' => 2,
            ];
            User::create($user);
            $anggota = $request->input();
            $anggota['no_anggota'] = $no_anggota;
            $anggota['user_id'] = $id;
            Anggota::create($anggota);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
        $notif = [
            'alert-type' => 'success',
            'message' => 'Anggota berhasil ditambahkan!'
        ];
        return redirect()->back()->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $anggota)
    {
        return Anggota::with('jurusan')->with('tahun_ajaran')->where('no_anggota', $anggota)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $anggota)
    {
        $validate = $request->validate([
            'nama_anggota' => 'required',
            'jurusan_id' => 'required',
            'tahun_ajaran_id' => 'required'
        ]);
        try {
            $data = $request->except('_token', '_method');
            // dd($data);
            Anggota::where('no_anggota', $anggota)->update($data);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
        $notif = [
            'alert-type' => 'success',
            'message' => 'Data Anggota Berhasil Diperbarui!'
        ];
        return redirect()->back()->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $anggota)
    {
        try {
            Anggota::where('no_anggota', $anggota)->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
        $notif = [
            'alert-type' => 'success',
            'message' => 'Anggota berhasil dihapus!'
        ];
        return redirect()->back()->with($notif);
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_anggota' => 'required'
        ]);
        try {
            Excel::import(new ImportAnggota, $request->file('import_anggota'));
            
        } catch (Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             return redirect()->back()->withErrors($failures);
        }
        $notification = [
            'alert-type' => 'success',
            'message' => 'Import Anggota Berhasil'
        ];
        return redirect()->back()->with($notification);
    }
}
