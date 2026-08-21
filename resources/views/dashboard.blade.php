<!-- memaanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'login')

@include('layouts.navbar')

<!-- batas awal isi konten -->
@section('content')

<style>
    :root {
        --green-darkest: #33623c;
        --green-primary:  #4f8a5b;
        --green-primary-hover: #3f7049;
        --green-soft:     #9fc7a8;
        --green-pale:     #eef5ef;
        --text-muted-green: #6b8f74;
    }

    .page-heading {
        font-weight: 800;
        color: var(--green-darkest);
        margin: 1.8rem 0 2rem;
    }

    .page-heading .tanggal-badge {
        display: block;
        margin-top: .4rem;
        font-size: 1rem;
        font-weight: 500;
        color: #fff;
        background-color: var(--green-primary);
        padding: .3rem 1rem;
        border-radius: 999px;
        width: fit-content;
        margin-left: auto;
        margin-right: auto;
    }

    .section-title {
        color: var(--green-darkest);
        font-weight: 700;
        font-size: 1.6rem;
        margin: 2rem 0 1.2rem;
        border-bottom: 2px solid var(--green-soft);
        display: inline-block;
        padding-bottom: .3rem;
    }

    .subsection-title {
        color: var(--green-darkest);
        font-weight: 600;
        font-size: 1.15rem;
    }

    .summary-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(51, 98, 60, 0.1);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .summary-card .card-header {
        background-color: var(--green-darkest);
        color: #fff;
        font-weight: 500;
        border-bottom: none;
    }

    .summary-card .card-body {
        background-color: var(--green-pale);
    }

    .summary-card .card-title {
        color: var(--green-primary-hover);
        font-weight: 700;
    }

    /* wrapper card untuk tabel supaya tidak polos */
    .table-card {
        background-color: #fff;
        border: 1px solid var(--green-soft);
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(51, 98, 60, 0.08);
        padding: .75rem 1rem 0.25rem;
        margin-bottom: 1rem;
    }

    .green-table {
        margin-bottom: .5rem;
    }

    .green-table thead th {
        background-color: var(--green-primary) !important;
        color: #fff !important;
        border: none;
        font-weight: 500;
    }

    .green-table thead tr th:first-child {
        border-top-left-radius: 8px;
    }

    .green-table thead tr th:last-child {
        border-top-right-radius: 8px;
    }

    .green-table tbody tr:hover {
        background-color: var(--green-pale);
    }

    .green-table tbody td,
    .green-table tbody th {
        border-color: #e3ece4;
    }

    .pagination .page-link {
        color: var(--green-primary);
        border-color: var(--green-soft);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
    }
</style>

    

    <div class="text-center">
        <h1 class="page-heading">
            Ringkasan Hari Ini
            <small class="tanggal-badge">
                {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
            </small>
        </h1>
        <div class="row">
            @can('viewAny', App\Models\User::class)
            <div class="col-md-12">
                <h1 class="section-title">Penjualan Hari Ini</h1>
            </div>
            <div class="col-md-6">
                <div class="card summary-card">
                    <div class="card-header">
                        Total Nilai Penjualan Hari ini
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Rp{{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card summary-card">
                    <div class="card-header">
                        Jumlah Transaksi Hari Ini
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"> {{ $ringkasan['total_transaksi'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="section-title">Status Pembayaran</h1>
            </div>
            <div class="col-md-6">
                <div class="card summary-card">
                    <div class="card-header">
                        Total Pembayaran Tunai
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Rp{{ number_format($ringkasan['total_cash'], 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card summary-card">
                    <div class="card-header">
                        Total Pembayaran Non-Tunai
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Rp{{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        <div class="row">
            <div class="col-md-12">
                <h1 class="section-title">Status Stok Kritis</h1>
            </div>
            <div class="col-md-6">
                <h3 class="subsection-title">Daftar Produk Stok Rendah</h3>
                <div class="table-card">
               <table class="table green-table">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produkStokRendah as $index => $produk)
                            <tr>
                                <th>{{ $produkStokRendah->firstItem() + $index}}</th>
                                <td>{{ $produk->nama}}</td>
                                <td>{{ $produk->stok}}</td>
                            </tr>
                        @empty
                            <tr>
                             <td colspan="3" class="text-muted text-center">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                    </div>
                    {{ $produkStokRendah->links()}}
                    </div>
                    <div class="col-md-6">
                        <h3 class="subsection-title">Produk Habis Stok</h3>
                        <div class="table-card">
                        <table class="table green-table">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produkStokHabis as $index => $produk)
                            <tr>
                                <th>{{ $produkStokHabis->firstItem() + $index}}</th>
                                <td>{{ $produk->nama}}</td>
                                <td>{{ $produk->stok}}</td>
                            </tr>
                        @empty
                            <tr>
                            <td colspan="3" class="text-muted text-center">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                    </div>
                    {{ $produkStokHabis->links()}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                       <h1 class="section-title">Produk Terlaris<h1>
                    </div>
                    <div class="col-md-12">
                        <div class="table-card">
                        <table class="table green-table">
                    <thead>
                        <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Unit Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produkTerlaris as $produk)
                            <tr>
                                <th>{{ $produk->nama }}</th>
                                <td>{{ $produk->stok}}</td>
                                <td>{{ $produk->total_terjual}}</td>
                            </tr>
                        @empty
                            <tr>
                             <td colspan="3" class="text-muted text-center">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                    </div>

                
                        
                    </div>
                </div>
            </div>

    <!-- batas akhir isi konten -->
@endsection