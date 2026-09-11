@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

<style>
    :root {
        --green-darkest: #33623c;
        --green-primary:  #4f8a5b;
        --green-soft:     #9fc7a8;
        --green-pale:     #eef5ef;
    }

    body {
        background-color: #f4f8f5;
    }

    .page-heading-detail {
        font-weight: 800;
        color: var(--green-darkest);
        margin: 1.8rem 0 1.2rem;
        text-align: center;
    }

    .struk-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 1.5rem;
    }

    .struk {
        background-color: #fff;
        width: 400px;
        max-width: 100%;
        padding: 2rem 1.75rem 1.75rem;
        border-radius: 12px;
        box-shadow: 0 10px 28px rgba(51, 98, 60, 0.14);
        color: #333;
        position: relative;
    }

    .struk::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: -10px;
        height: 20px;
        background:
            linear-gradient(-45deg, #fff 10px, transparent 0) 0 10px,
            linear-gradient(45deg, #fff 10px, transparent 0) 0 10px;
        background-repeat: repeat-x;
        background-size: 20px 20px;
    }

    .struk-header {
        text-align: center;
        margin-bottom: 1.1rem;
    }

    .struk-header .toko-name {
        font-family: 'Segoe UI', system-ui, sans-serif;
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--green-darkest);
        letter-spacing: .5px;
        margin-bottom: .2rem;
    }

    .struk-header .toko-sub {
        font-family: 'Segoe UI', system-ui, sans-serif;
        font-size: .78rem;
        color: #999;
    }

    .struk-divider {
        border-top: 1.5px dashed var(--green-soft);
        margin: 1rem 0;
    }

    .struk-info {
        font-family: 'Courier New', monospace;
        font-size: .82rem;
        line-height: 1.7;
    }

    .struk-info .row-item {
        display: flex;
        justify-content: space-between;
        gap: .5rem;
    }

    .struk-info .row-item span:first-child {
        color: #999;
    }

    .struk-info .row-item span:last-child {
        font-weight: 600;
        color: #333;
    }

    .struk-items {
        font-family: 'Courier New', monospace;
    }

    .struk-items .item-row {
        padding-bottom: .7rem;
        margin-bottom: .7rem;
        border-bottom: 1px dotted #e8f0e9;
    }

    .struk-items .item-row:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .struk-items .item-name {
        font-size: .87rem;
        font-weight: 700;
        color: #222;
        margin-bottom: .15rem;
    }

    .struk-items .item-detail {
        display: flex;
        justify-content: space-between;
        font-size: .8rem;
        color: #777;
    }

    .struk-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: 'Courier New', monospace;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--green-darkest);
        margin-top: .3rem;
    }

    .struk-status {
        text-align: center;
        margin-top: 1.2rem;
    }

    .struk-status .badge-status {
        background-color: var(--green-pale);
        color: var(--green-darkest);
        font-weight: 700;
        font-size: .72rem;
        letter-spacing: 1.5px;
        padding: .4rem 1.2rem;
        border-radius: 999px;
        display: inline-block;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    .struk-footer {
        text-align: center;
        font-family: 'Segoe UI', system-ui, sans-serif;
        font-size: .78rem;
        color: #aaa;
        margin-top: 1.3rem;
        font-style: italic;
    }

    .btn-kembali {
        border: 1.5px solid var(--green-primary);
        color: var(--green-primary);
        background: transparent;
        border-radius: 8px;
        font-weight: 500;
        padding: .55rem 1.5rem;
    }

    .btn-kembali:hover {
        background-color: var(--green-primary);
        color: #fff;
    }
</style>

<h1 class="page-heading-detail">Detail Penjualan</h1>

<div class="struk-wrapper">
    <div class="struk">

        <div class="struk-header">
            <div class="toko-name">Dapur Nusantara</div>
            <div class="toko-sub">Detail Transaksi Penjualan</div>
        </div>

        <div class="struk-divider"></div>

        <div class="struk-info">
            <div class="row-item">
                <span>No. Transaksi</span>
                <span>#{{ str_pad($sale->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="row-item">
                <span>Tanggal</span>
                <span>{{ $sale->created_at ? $sale->created_at->translatedFormat('d-m-Y') : '-' }}</span>
            </div>
            <div class="row-item">
                <span>Waktu</span>
                <span>{{ $sale->created_at ? $sale->created_at->translatedFormat('H:i:s') : '-' }}</span>
            </div>
            <div class="row-item">
                <span>Kasir</span>
                <span>{{ $sale->user->name ?? '-' }}</span>
            </div>
        </div>

        <div class="struk-divider"></div>

        <div class="struk-items">
            @forelse ($sale->itemPenjualan as $item)
            <div class="item-row">
                <div class="item-name">{{ $item->produk->nama ?? 'Produk tidak ditemukan' }}</div>
                <div class="item-detail">
                    <span>{{ $item->kuantitas }} x Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                    <span>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
            @empty
            <div class="text-center text-muted" style="font-size:.8rem;">Tidak ada item.</div>
            @endforelse
        </div>

        <div class="struk-divider"></div>

        <div class="struk-total">
            <span>TOTAL</span>
            <span>Rp{{ number_format($sale->total_pembayaran, 0, ',', '.') }}</span>
        </div>

        <div class="struk-info" style="margin-top:.7rem;">
            <!-- Hanya tampilkan Uang Masuk dan Kembalian jika metode pembayarannya BUKAN QRIS -->
            @if(($sale->metode_pembayaran ?? '') !== 'QRIS')
                <div class="row-item">
                    <span>Uang Masuk</span>
                    <span>Rp{{ number_format($sale->uang_masuk ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="row-item">
                    <span>Kembalian</span>
                    <span>Rp{{ number_format($sale->uang_kembalian ?? 0, 0, ',', '.') }}</span>
                </div>
            @endif
            
            <div class="row-item">
                <span>Metode Bayar</span>
                <span>{{ $sale->metode_pembayaran ?? '-' }}</span>
            </div>
        </div>

       

        <div class="struk-footer">
            *** Terima Kasih ***
        </div>

    </div>
</div>

<div class="text-center">
    <a href="{{ route('penjualan.index') }}" class="btn btn-kembali">Kembali</a>
</div>

@endsection
