<?php
 
 use App\Http\Controllers;
 use App\Http\Controllers\Backend\PengalamanKerjaController;
 use App\Http\Controllers\Backend\PendidikanController;
 use App\Http\Controllers\Frontend\HomeController;
 use App\Http\Controllers\ManagementUserController;
 use App\Http\Controllers\SessionController;
 use App\Http\Controllers\PegawaiController;
 use App\Http\Controllers\UploadController;
 use App\Http\Controllers\User\UserController;
 use App\Http\Controllers\CobaController;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Route;
 use Illuminate\Support\Facades\Auth;
 
 //ACARA 3
 //route name
 Route::get('/', function () {
     return view('welcome');
 });
 
 //Basic route
 Route::get('/foo', function() {
     return "Hello World";
 });
 
 //parameter route
 Route::get('/foo/{id}', function ($id) {
     return 'User ' . $id;
 });
 
 //Menentukan parameter route yang diperlukan
 Route::get('posts/{post}/comments/{comment}', function ($postID, $commentID) {
     //
 });
 
 //File Route Default
 Route::get('/user', [UserController::class, 'viewUser'])->name('user');
 
 //Route method  post
 Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
 
 //Method Route
 //Route::get($uri, $callback);
 //Route::post($uri, $callback);
 //Route::put($uri, $callback);
 //Route::patch($uri, $callback);
 //Route::delete($uri, $callback);
 //Route::options($uri, $callback);
 
 Route::match(['get', 'post'], '/', function () {
     //
 });
 
 Route::any('/', function () {
     //
 });
 
 //Redirect route
 Route::redirect('/here', '/there');
 
 //Redirect route with status
 Route::redirect('/here301', '/there', 301); //move permanent
 Route::redirect('/here302', '/there', 302); //found (temporary)
 Route::redirect('/here303', '/there', 303); //see other
 Route::redirect('/here307', '/there', 307); //temporary redirect
 Route::redirect('/here308', '/there', 308); //permanen redirect
 
 //Route view
 Route::view('/welcome', 'welcome');
 Route::view('/welcome', 'welcome', ['name' => 'Aulia']);
 
 //Parameter opsional
 Route::get('user/{name?}', function ($name = null) {
     return $name;
 });
 Route::get('user/{name?}', function ($name = 'Silmi') {
     return $name;
 });
 
 //Regular Expression Constraint
 Route::get('user/{name}', function ($name) {
     //
 })->where('name', '[A-Za-z]+');
 Route::get('user/{id}', function ($id) {
     //
 })->where('id', '[0-9]+');
 Route::get('user/{id}/{name}', function ($id, $name) {
     //
 })->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
 
 //Global Constraint
 Route::get('/nameGlobal/{nameGlobal}', function ($nameGlobal) {
     return "Hellow, $nameGlobal!";
 });
 Route::get('/idGlobal/{idGlobal}', function ($idGlobal) {
     return "User ID: $idGlobal";
 });
 
 //Encoded Forward Slashes
 Route::get('/search/{search}', function ($search) {
     return $search;
 })->where('search', '.*');
 
 //Acara4
 //Generate URL ke Route Bersama
 Route::get('/profile', [UserController::class, 'showProfile'])->name('profileku');
 Route::get('generate-url', [UserController::class, 'generateProfileUrl']);
 Route::get('/redirect-profile', [UserController::class, 'redirectToProfile']);
 Route::get('/params/{id?}', function ($id) {
     return "ID diterima: " . $id;
 })->name('params_id');
 Route::get('/test-url', function () {
     $url = route('params_id', ["id" => 5]);
     dd($url);
 });
 
 //check route
 Route::get('/profileCek', [UserController::class, 'showProfile']) ->name('profile')
 ->middleware('check.route'); //diambil dari app
 
 //middleware
 Route::middleware(['check.user'])->group(function () {
     Route::get('/dashboard', [UserController::class, 'dashboardLog'])->name('Dashboard');
     Route::get('/profileL', [UserController::class, 'profileLog'])->name('Profile');
     Route::get('/settings', [UserController::class, 'settingsLog'])->name('Settings');
 });
 
 //Namespaces
 Route::namespace('App\Http\Controllers\User')->group(function () {
     Route::get('/user/info', 'UserController@info')->name('user.info');
     Route::get('/user/data', 'DataController@data')->name('user.data');
 });
 
 //Subdomain Routing
 Route::domain('{account}.example.com')->group(function () {
     Route::get('/', function ($account) {
         return "Ini adalah halaman akun: " . $account;
     });
 });
 
 //Prevfix
 Route::prefix('admin')->group(function () {
     Route::get('/dashboard', function () {
         return "Halaman dashboard admin.";
     });
     Route::get('/db', function () {
         return "Halaman db admin.";
     });
 });
 
 //Name prefix
 Route::name('pre')->prefix('tryagain')->group(function () {
     Route::get('/dashboard', function () {
         return "Halaman dashboard prefix name.";
     })->name('pv.dashboard');
 
     Route::get('/user', function () {
         return "Halaman pengguna prefix name.";
     })->name('pv.user');
 });
 
 //Acara5
 Route::resource('/managuser', ManagementUserController::class);
 // Route::get('/managuser', [ManagementUserController::class, 'index']);
 // Route::get('/managuser/create', [ManagementUserController::class, 'create']);
 // Route::post('/managuser', [ManagementUserController::class, 'store']);
 // Route::get('/managuser/{id}', [ManagementUserController::class, 'show']);
 // Route::get('/managuser/{id}/edit', [ManagementUserController::class, 'edit']);
 // Route::put('/managuser/{id}', [ManagementUserController::class, 'update']);
 // Route::delete('/managuser/{id}', [ManagementUserController::class, 'destroy']);
 
 //Acara 6
 //Membuat view sederhana
 //Route::get('/home', function () {
 //    return view('home');  
 //});
 Route::get('/managhome', [ManagementUserController::class, 'index']);
 // Route::get('/coba/butterfly', function() {
 //     return view('frontend.butterfly');
 // });
 
 //Acara 7 frontend
 Route::group(['namespace' => 'App\Http\Controllers\Frontend'], function () {
     Route::resource('homeee', HomeController::class);
 });
 
 //Acara 8 backend
 //Acara 8 backend + acara 13-16 crud
 Route::group(['namespace' => 'App\Http\Controllers\Backend'], function() {
     Route::resource('dashboard', 'DashboardController');
     Route::resource('pengalaman_kerja', PengalamanKerjaController::class);
     Route::resource('pendidikan', PendidikanController::class);
 });
 
 Auth::routes();
 
 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
 //Acara 17
 //create session
 Route::get('/session/create', [SessionController::class, 'create']);
 //show session
 Route::get('/session/show', [SessionController::class, 'show']);
 //delete session
 Route::get('session/delete',[SessionController::class, 'delete']);
 
 //menangkap data URI parameter variable
 Route::get('/pegawai/{nama}',[PegawaiController::class, 'index']);
 
 //menangkap data melalui inputan
 Route::get('/formulir',[PegawaiController::class, 'formulir']);
 Route::post('/formulir/proses',[PegawaiController::class, 'proses'])->name('formulir.proses');
 
 //acara 18 
 //coba error
 Route::get('/cobaerror', [CobaController::class,'index']);
 Route::get('/cobaerror/{nama?}',[CobaController::class, 'index']);
 
 //Acara19
 //upload dan proses upload
 Route::get('/upload', [UploadController::class, 'upload']);
 Route::post('/upload/proses', [UploadController::class, 'proses_upload'])->name('upload.proses');
 
 //route menuju ke function resize_upload
 Route::get('/upload/resize', [UploadController::class, 'resize_upload'])->name('upload.resize');
 Route::post('/upload/resize/proses', [UploadController::class, 'proses_upload_resize'])->name('upload.proses.resize');
 
 //Acara 20
 //Multiple Upload menggunakan dropzone
 Route::get('/dropzone', [UploadController::class, 'dropzone'])->name('dropzone');
 Route::post('/dropzone/store', [UploadController::class, 'dropzone_store'])->name('dropzone.store');
 
 //Route untuk upload pdf 
 Route::get('/pdf_upload', [UploadController::class, 'pdf_upload'])->name('pdf.upload');
 Route::post('/pdf/store', [UploadController::class, 'pdf_store'])->name('pdf.store');
 
 //Acara 21
 // Route::middleware('auth:api')->get('/user', function (Request $request) {
 //     return $request->user();
 // });