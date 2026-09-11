@extends('layouts.app')

@section('title', 'Tentang')

@include('layouts.navbar')

@section('content')

<style>
    :root {
        --green-darkest: #33623c;
        --green-primary:  #4f8a5b;
        --green-soft:     #9fc7a8;
        --green-pale:     #eef5ef;
    }

    .page-heading-tentang {
        font-weight: 800;
        color: var(--green-darkest);
        margin: 1.8rem 0 1.2rem;
        text-align: center;
    }

    .tentang-card {
        background-color: #fff;
        border: 1px solid var(--green-soft);
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(51, 98, 60, 0.1);
        padding: 2.5rem;
        max-width: 600px;
        margin: 0 auto 2rem;
        text-align: center;
    }

    .foto-profil {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--green-primary);
        margin-bottom: 1.2rem;
    }

    .nama-profil {
        color: var(--green-darkest);
        font-weight: 800;
        font-size: 1.4rem;
        margin-bottom: .2rem;
    }

    .role-profil {
        color: var(--green-primary);
        font-weight: 500;
        margin-bottom: 1.5rem;
    }

    .divider-tentang {
        border-top: 1px dashed var(--green-soft);
        margin: 1.5rem 0;
    }

    .deskripsi-app {
        text-align: left;
        color: #444;
        line-height: 1.7;
    }

    .deskripsi-app h5 {
        color: var(--green-darkest);
        font-weight: 700;
        margin-bottom: .8rem;
    }

    .deskripsi-app ul {
        padding-left: 1.2rem;
        margin-bottom: 0;
    }

    .deskripsi-app li {
        margin-bottom: .5rem;
    }
</style>

<h1 class="page-heading-tentang">Tentang</h1>

<div class="tentang-card">
    <img src="{{ asset('assets/img/tata.jpg') }}" alt="" class="foto-profil">
    <div class="nama-profil">Sintha Melinda</div>
    <div class="role-profil">Developer</div>

    <div class="divider-tentang"></div>

    <div class="deskripsi-app">
        <h5>Tentang Aplikasi</h5>
        <p>
            Dapur Nusantara adalah aplikasi Point of Sale (POS) berbasis web dengan menggunakan framework Laravel untuk membantu proses transaksi penjualan makanan dan minuman secara digital.
        </p>
        <h5>Cara kerja aplikasi:</h5>
        <ul>
            <li><strong>Login</strong> — pengguna masuk sesuai peran (Admin atau Kasir).</li>
            <li><strong>Dashboard</strong> — ringkasan penjualan & stok ditampilkan otomatis.</li>
            <li><strong>Kelola Data</strong> — Admin mengatur data user, jenis, dan produk.</li>
            <li><strong>Transaksi</strong> — Kasir memilih produk, sistem menghitung total otomatis.</li>
            <li><strong>Checkout</strong> — pembayaran dipilih (Cash/QRIS), transaksi tersimpan.</li>
            
        </ul>
    </div>
</div>

@endsection