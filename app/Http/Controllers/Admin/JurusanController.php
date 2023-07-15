<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jurusans'] = Jurusan::orderBy('nama_jurusan', 'asc')->get();
        return view('admin.jurusan.index')->with($data);
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
            'nama_jurusan' => 'required|unique:jurusans,nama_jurusan',
        ]);
        try {
            Jurusan::create($request->all());
            $notification = [
                'alert-type' => 'success',
                'message' => 'Jurusan Berhasil Ditambahakan',
            ];
            return redirect()
            ->back()
            ->with($notification);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()
            ->back()
            ->withErrors('Gagal Menambahkan Jurusan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return $jurusan;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $jurusan)
    {
        $validate = $request->validate([
            'nama_jurusan' => 'required|unique:jurusans,nama_jurusan',
        ]);
        try {
            Jurusan::where('id', $jurusan)->update([
                'nama_jurusan' => $request->nama_jurusan
            ]);
            $notification = [
                'alert-type' => 'success',
                'message' => 'Jurusan Berhasil Diperbarui',
            ];
            return redirect()
            ->back()
            ->with($notification);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()
            ->back()
            ->withErrors('Gagal memperbarui Jurusan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        //
    }
}
