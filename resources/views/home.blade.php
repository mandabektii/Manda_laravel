<a href="{{ route('dashboard') }}">Ke Dashboard</a>
<a href="{{ route('profile') }}">Go to Profile</a>
<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
</head>
<body>
    <h1>Selamat Datang di Halaman Home</h1>
</body>
</html>
@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <h1>Selamat Datang di {{ $name }}</h1>
@endsection


