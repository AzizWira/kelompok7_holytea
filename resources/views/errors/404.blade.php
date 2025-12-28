@extends('user.layout')

@section('title', '404 - Not Found')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endpush

@section('content')
    <div class="body" style="margin-top:140px; text-align:center;">
        <h1 style="font-size:40px; color:#21963B;">404</h1>
        <p style="font-size:18px; color:#444;">Halaman tidak ditemukan.</p>
        <a href="{{ route('home') }}" style="font-size:18px; color:#21963B; text-decoration:underline;">Kembali ke
            Beranda</a>
    </div>
@endsection