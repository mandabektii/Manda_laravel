<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use illuminate\Http\Request;

class DataController extends Controller {
    public function data() {
        return "Ini dari data controller namespace";
    }
}