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
    
    
    .foto-tentang-card {
        width: 120px;          
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--green-primary);
        box-shadow: 0 4px 10px rgba(51, 98, 60, 0.15); 
        margin: 0 auto 1.2rem; 
        display: block;
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
        font-style: italic;
    }

    .divider-tentang {
        border-top: 1px dashed var(--green-soft);
        margin: 1.5rem 0;
    }

    .deskripsi-app {
        text-align: left;
        color: #444;
        line-height: 1.8;
        margin-bottom: 1.6rem;
    }

    .deskripsi-app:last-child {
        margin-bottom: 0;
    }

    .deskripsi-app h5 {
        color: var(--green-darkest);
        font-weight: 700;
        margin-bottom: .9rem;
        font-size: 1.05rem;
    }

    .deskripsi-app p {
        margin-bottom: 0;
    }

    .deskripsi-app ul {
        padding-left: 1.3rem;
        margin-bottom: 0;
    }

    .deskripsi-app li {
        margin-bottom: .6rem;
    }

    .deskripsi-app li:last-child {
        margin-bottom: 0;
    }

    .alamat-box {
        background-color: var(--green-pale);
        border-radius: 10px;
        padding: .9rem 1.1rem;
        color: var(--green-darkest);
        font-weight: 600;
        line-height: 1.6;
    }

    .copyright-tentang {
        text-align: center;
        color: #8a9a8d;
        font-size: .8rem;
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid var(--green-pale);
    }
</style>

<h1 class="page-heading-tentang">Tentang</h1>

<div class="tentang-card">
    <!-- Perbaikan: Class diganti menjadi foto-tentang-card -->
    <img src="{{ asset('assets/img/dapur.jpg') }}" alt="Logo Dapur Nusantara" class="foto-tentang-card">
    
    <div class="nama-profil">Dapur Nusantara</div>
    <div class="role-profil">Makanan dan Minuman Nuansa Nusantara</div>

    <div class="divider-tentang"></div>

    <div class="deskripsi-app">
        <h5 class="text-center fw-bold">Cerita Kami</h5>
        <p>
            Dapur Nusantara hadir dengan satu tujuan sederhana yaitu menghadirkan
            kembali cita rasa masakan tradisional Indonesia yang mulai jarang
            ditemui di tengah gempuran makanan modern. Setiap hidangan kami
            racik dengan resep otentik yang tetap mempertahankan cita rasa
            asli Nusantara.
        </p>
    </div>

    <div class="deskripsi-app">
        <h5 class="text-center fw-bold">Komitmen Kami</h5>
        <p>
            Kami berkomitmen menggunakan bahan-bahan segar dan berkualitas
            di setiap masakan, dengan harga yang tetap ramah di kantong.
            Suasana yang hangat dan cita rasa autentik membuat setiap kunjungan
            terasa seperti pulang ke rumah.
        </p>
    </div>
     
    <div class="deskripsi-app">
        <h5 class="text-center fw-bold">Alamat</h5>
        <div class="alamat-box">
            Jl. Cilolohan, Kahuripan, Kec. Tawang, Kab. Tasikmalaya, Jawa Barat
        </div>
    </div>

    <div class="copyright-tentang">
        &copy; {{ date('Y') }} Dapur Nusantara. 
    </div>
</div>

@endsection