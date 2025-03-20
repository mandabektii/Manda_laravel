<?php
 
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\File;
 use Intervention\Image\ImageManager;
 
 class UploadController extends Controller
 {
     public function upload() {
         return view('upload');
     }
 
     public function proses_upload(Request $request) {
         $this->validate($request, [
             'file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
             'keterangan' => 'required',
         ]);
 
         //menyimpan data yang diupload e variabel file
         $file = $request->file('file');
         //nama file
         echo 'File Name: ' .$file->getClientOriginalName().'<br>';
         //Ekstensi file
         echo 'File Extension: ' .$file->getClientOriginalExtension().'<br>';
         //real path
         echo 'File Real Path: ' .$file->getRealPath().'<br>';
         //ukuran file
         echo 'File Size: ' .$file->getSize().'<br>';
         //tipe mime
         echo 'File Mime Type: ' .$file->getMimeType();
         //isi dengan nama folder tempat kemana file diupload
         $tujuan_upload = public_path('data_file');
         //Upload File
         $file->move($tujuan_upload, $file->getClientOriginalName());
     }
 
     public function resize_upload() {
         return view('resize_upload');
     }
 
     Public function proses_upload_resize(Request $request, ImageManager $imageManager) {
         $request->validate([
             'file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
             'keterangan' => 'required',
         ]);
 
         //Tentukan path lokasi upload
         $path = public_path('img/logo');
 
         //jika folder belum ada
         if (!File::isDirectory($path)) {
             //maka folder tersebut akan dibuat
             File::makeDirectory($path, 0777, true);
         }
 
         //mengambil file image dari form
         $file = $request->file('file');
 
         //membuat name file dari gabungan tanggal dan uniqid()
         $fileName = 'logo_'. uniqid() . '.' .$file->getClientOriginalExtension();
 
         //membaca gambar melalui ImageManager
         $image = $imageManager->read($file->getRealPath());
 
         //resize image sesuai dimensi dengan mempertahankan ratio
         $resizeImage = $image->cover(200,200);
 
         //simpan image ke folder
         file_put_contents($path . '/' . $fileName, $resizeImage->toJpeg());
         return redirect(route('upload.resize'))->with('success', 'Data berhasil ditambahkan!');
     }
 
     public function dropzone() {
         return view('dropzone');
     }
 
     public function dropzone_store(Request $request) {
         $image = $request->file('file');
         $request->validate([
             'file.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
         ]);
 
         $uploadedFiles = [];
 
         if ($request->hasFile('file')) {
             foreach ($request->file('file') as $image) {
                 $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                 $image->move(public_path('img/dropzone'), $imageName);
                 $uploadedFiles[] = $imageName;
             }
         }
        }
    }
}