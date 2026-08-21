{{--memanggil file app.blade.php--}}
@extends('layouts.app')

{{--mengirimkan nilai ke title untuk ditampilkan--}}
@section('title', 'login')

{{--batas awal isi konten--}}
@section('content')

<style>
    :root {
        --green-darkest: #33623c;   /* hierarki tertinggi: header, teks penting */
        --green-primary:  #4f8a5b;  /* tombol, elemen interaktif utama */
        --green-primary-hover: #3f7049;
        --green-soft:     #9fc7a8;  /* border, elemen sekunder */
        --green-pale:     #eef5ef;  /* background halus */
        --text-muted-green: #6b8f74;
    }

    .login-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(51, 98, 60, 0.12);
        overflow: hidden;
        width: 22rem;
    }

    .login-card .card-header {
        background-color: var(--green-darkest);
        color: #fff;
        font-weight: 600;
        font-size: 1.15rem;
        letter-spacing: .3px;
        border-bottom: none;
        padding: 1.1rem 1rem;
    }

    .login-card .card-body {
        padding: 2rem 1.75rem;
        background-color: var(--green-pale);
    }

    

    .login-card .form-label {
        color: var(--green-darkest);
        font-weight: 500;
        font-size: .88rem;
    }

    .login-card .form-control {
        border: 1px solid var(--green-soft);
        border-radius: 8px;
        padding: .6rem .8rem;
        background-color: #fff;
    }

    .login-card .form-control:focus {
        border-color: var(--green-primary);
        box-shadow: 0 0 0 .2rem rgba(79, 138, 91, .2);
    }

    .btn-green {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
        border-radius: 8px;
        padding: .55rem 0;
        font-weight: 600;
        width: 100%;
        transition: background-color .2s ease;
    }

    .btn-green:hover {
        background-color: var(--green-primary-hover);
        border-color: var(--green-primary-hover);
        color: #fff;
    }
</style>

    <div class="card text-center login-card position-absolute top-50 start-50 translate-middle">
        <h5 class="card-header">Login POS</h5>
        <div class="card-body">
            <form action="{{ route('auth') }}" method='POST'>
                @csrf
                <div class="mb-3 text-start">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email"class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" autocomplete="off">
                    @error('email')
                        <div class=" badge text-bg-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    @error('password')
                        <div class=" badge text-bg-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-green">Submit</button>
            </form>
            
        </div>
    </div>
    <!--batas akhir isi konten-->
@endsection