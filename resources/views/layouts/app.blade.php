<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- isi title yang kita kirimkan dari views lain-->
    <title>@yield('title')</title>
    <!-- memanggil file css bootstrap -->
    @vite('resources/css/app.css', 'resources/js/app.js')
    @include('layouts.responsive')
</head>

<body>

    <!-- 1. Letakkan komponen Navbar di sini jika ingin dipisahkan global -->
    @yield('navbar') 

    <div class="container mt-3">

        <!-- 2. Taruh pemberitahuan sukses di sini (Sekarang posisinya di bawah navbar) -->
        @if (session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- 3. Isi konten halaman utama seperti tabel dan tombol -->
        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>