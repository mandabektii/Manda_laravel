<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use illuminate\Http\Request;

class UserController extends Controller {
    public function viewUser() {
        return view('user.add_user');
    }

    public function store(Request $request) {
        $name = $request->input('name');
        $email = $request->input('email');

        return view('user.result', compact('name', 'email'));
    }

    public function showProfile() {
        return "Ini adalah halaman profile";
    }

    public function generateProfileUrl() {
        $url = route('profileku');
        return "URL adalah: " . $url;
    }

    public function redirectToPorfile() {
        return redirect()->route('profileku');
    }

    public function dashboardLog() {
        return "Selamat datang di halaman Dashboard Login" ;
    }

    public function profileLog() {
        return "Ini adalah halaman profile Login" ;
    }

    public function settingLog() {
        return "Ini adalah halaman pengaturan bagi yang sudah login" ;
    }

    public function info() {
        return "Ini info dari User Controller namespace";
    }
}