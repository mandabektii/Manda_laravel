<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SessionController extends Controller
{
    
    //membuat session
    public function create(Request $request) {
        $request->session()->put('nama', 'Politeknik Negeri Jember');
        echo "Data telah ditambahkan ke session";
    }

    //menampilkan isi session
    public function show(Request $request) {
        if($request->session()->has('nama')) {
            echo $request->session()->get('nama');
        } else {
            echo 'Tidak ada data dalam session.';
        }
    }

    //menghapus session
    public function delete(Request $request) {
        $request->session()->forget('nama');
        echo "Data telah dihapus dari session.";
    }
    
}