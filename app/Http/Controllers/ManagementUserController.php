<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementUserController extends Controller
{
    public function index()
    {
        $nama = "Politeknik Negeri Jember";
        return view('home', ['name' => $nama]);
    }
}
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagementUser extends Model
{
    protected $table = 'users';
}


