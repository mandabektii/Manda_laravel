<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PengalamanKerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PengalamanKerjaController extends Controller
{
    public function index()
    {
        $pengalaman_kerja = PengalamanKerja::all();

        return view('backend.pengalaman_kerja.index', compact('pengalaman_kerja'));
    }
    public function create()
    {
        return view('backend.pengalaman_kerja.create');
    }
    public function store(Request $request)
    {
        $request ->validate([
            'nama' => 'required|string|max:225',
            'jabatan' => 'required|string|max:225',
            'tahun_masuk' => 'required|integer|digits:4|min:1901|max:2155',
            'tahun_keluar' => 'nullable|integer|digits:4|min:1901|max:2155',
        ]);

        DB::table('pengalaman_kerja')->insert([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar,
        ]);
        return redirect()->route('pengalaman_kerja.index')
                        ->with('succes','Data pengalaman_kerja baru telah berhasil disimpan');
    }

    public function edit($id){
        $pengalaman_kerja = DB::table('pengalaman_kerja')->where('id', $id)->first();
        return view('backend.pengalaman_kerja.edit', compact('pengalaman_kerja'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tahun_masuk' => 'required|integer|digits:4|min:1901|max:2155',
            'tahun_keluar' => 'nullable|integer|digits:4|min:1901|max:2155',
        ]);
        
        DB::table('pengalaman_kerja')->where('id', $id)->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar
        ]);

        return redirect()->route('pengalaman_kerja.index')->with('success', 'Data pengalaman kerja berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('pengalaman_kerja')->where('id', $id)->delete();
        return redirect()->route('pengalaman_kerja.index')->with('success', 'Data pengalaman kerja berhasil dihapus.');
    }
}
