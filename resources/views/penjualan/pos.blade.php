@extends('layouts.app')

@section('title', 'POS')

@section('content')

<style>
    :root {
        --green-darkest: #33623c;
        --green-primary:  #4f8a5b;
        --green-primary-hover: #3f7049;
        --green-soft:     #9fc7a8;
        --green-pale:     #eef5ef;
    }

    .page-heading-pos {
        font-weight: 800;
        color: var(--green-darkest);
    }

    .pos-card {
        border: 1px solid var(--green-soft);
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(51, 98, 60, 0.08);
        overflow: hidden;
    }

    .pos-card .card-body,
    .pos-card .card-footer {
        background-color: #fff;
    }

    .search-produk-pos .form-control {
        border: 1px solid var(--green-soft);
        border-radius: 8px;
        padding: .55rem .9rem;
    }

    .search-produk-pos .form-control:focus {
        border-color: var(--green-primary);
        box-shadow: 0 0 0 .2rem rgba(79, 138, 91, .2);
    }

    .produk-pick-btn {
        border: 1px solid var(--green-soft) !important;
        color: var(--green-darkest) !important;
        border-radius: 10px !important;
        transition: background-color .2s ease, border-color .2s ease;
    }

    .produk-pick-btn:hover {
        background-color: var(--green-pale) !important;
        border-color: var(--green-primary) !important;
    }

    .produk-pick-btn img {
        border: 1px solid var(--green-soft);
    }

    .produk-harga {
        color: var(--green-primary-hover);
        font-weight: 600;
    }

    .qty-input-pos.form-control {
        border: 1px solid var(--green-soft);
        border-radius: 8px;
    }

    .qty-input-pos.form-control:focus {
        border-color: var(--green-primary);
        box-shadow: 0 0 0 .2rem rgba(79, 138, 91, .2);
    }

    .btn-add-pos {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-add-pos:hover {
        background-color: var(--green-primary-hover);
        border-color: var(--green-primary-hover);
        color: #fff;
    }

    .keranjang-table thead th {
        background-color: var(--green-primary);
        color: #fff;
        border-color: var(--green-primary);
        font-weight: 500;
    }

    .keranjang-table tbody tr:hover {
        background-color: var(--green-pale);
    }

    .keranjang-table tbody td {
        border-color: var(--green-soft);
        vertical-align: middle;
    }

    .qty-cart-input {
        border: 1px solid var(--green-soft);
        border-radius: 6px;
    }

    .btn-hapus-item {
        background-color: #c0463f;
        border-color: #c0463f;
        color: #fff;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-hapus-item:hover {
        background-color: #a53a34;
        border-color: #a53a34;
        color: #fff;
    }

    .pos-card .card-footer {
        border-top: 1px solid var(--green-soft);
        padding: 1rem;
    }

    .total-bayar-pos {
        color: var(--green-darkest);
        font-size: 1.3rem;
        display: block;
        margin-bottom: .75rem;
    }

    .payment-select-pos {
        border: 1px solid var(--green-soft);
        border-radius: 8px;
    }

    .payment-select-pos:focus {
        border-color: var(--green-primary);
        box-shadow: 0 0 0 .2rem rgba(79, 138, 91, .2);
    }

    .btn-checkout-pos {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
    }

    .btn-checkout-pos:hover {
        background-color: var(--green-primary-hover);
        border-color: var(--green-primary-hover);
        color: #fff;
    }

    .btn-batalkan-pos {
        color: #c0463f;
        border-color: #c0463f;
        font-weight: 500;
        border-radius: 8px;
    }

    .btn-batalkan-pos:hover {
        background-color: #c0463f;
        border-color: #c0463f;
        color: #fff;
    }
</style>

@if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<h4 class="mb-3 page-heading-pos">
    {{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}
</h4>

<div class="row">



{{-- ========== PRODUK ========== --}}
<div class="col-md-6">
    <div class="card pos-card">
        <div class="card-body" style="max-height:70vh; overflow:auto">
            <div class="mb-3 search-produk-pos">
                <form method="GET" action="{{ route('penjualan.create') }}">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari produk..."
                        onkeyup="this.form.submit()">
                </form>
            </div>
            @foreach($products as $product)
                <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="col-7">
                        <button class="btn btn-outline-primary produk-pick-btn w-100 text-start p-2 {{ $sale->status ===
                        'COMPLETED' ? 'disabled' : '' }}">
                            <div class="d-flex align-item-center gap-2">

                                {{-- Gambar produk --}}
                                <img src="{{ asset('storage/'.$product->foto) }}"
                                     alt="Gambar"
                                     class="rounded-circle"
                                     style="width: 45px; height: 45px; object-fit:cover;">

                                {{-- Nama & harga --}}
                                <div>
                                    <div class="fw-semibold">{{ $product->nama }}</div>
                                    <small class="produk-harga">{{ number_format($product->harga_jual) }}</small>
                                </div>
                            </div>
                        </button>
                    </div>


                    <div class="col-3">
                        <input type="number" name="quantity" value="1" min="1"
                                class="form-control qty-input-pos {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                    </div>

                    <div class="col-2">
                        <button class="btn btn-primary btn-add-pos w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">+</button>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
</div>

{{-- ========== KERANJANG ========== --}}
<div class="col-md-6">
    <div class="card pos-card">
        <table class="table table-bordered mb-0 keranjang-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    @if (auth()->user()->role_id === 1)
                    <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($sale->itemPenjualan as $item)
                <tr>
                    <td>{{ $item->produk->nama }}</td>
                        <td>Rp {{ number_format($item->produk->harga_jual) }}</td>
                        <td>
                             <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                     @csrf @method('PUT')
                                         <input type="number" name="quantity"
                                          value="{{ $item->kuantitas }}"
                                          class="form-control form-control-sm qty-cart-input">
                             </form>
                        </td>
                        <td>Rp {{ number_format($item->subtotal) }}</td>
                        @if (auth()->user()->role_id === 1)
                        <td>
                            @can('delete', $item)
                            <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                 @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm btn-hapus-item">Hapus</button>
                            </form>
                            @endcan
                        </td>
                        @endif
                </tr>
                @empty
                 <tr>
                    <td colspan="{{ auth()->user()->role_id === 1 ? 5 : 4 }}" class="text-center text-muted">
                    Keranjang Kosong
                    </td>
            
                </tr>
                    @endforelse
            </tbody>
        </table>


         <div class="card-footer">
            <strong class="total-bayar-pos">Rp {{ number_format($sale->total_pembayaran) }}</strong>

            <form method="POST" 
                 action="{{ route('penjualan.update', $sale->id) }}" 
                 onsubmit="return confirm('Yakin ingin checkout?')" class="mt-2">
                @csrf
                @method('PUT')
                <select name="payment_method" class="form-select mb-2 payment-select-pos">
                    <option value="">Pilih Pembayaran</option>
                    <option value="CASH">Cash</option>
                    <option value="QRIS">QRIS</option>
                </select>

                <button class="btn btn-success btn-checkout-pos w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                    Checkout
                </button>
             </form>
            @can('delete', $sale)
            <form action="{{ route('penjualan.destroy', $sale->id) }}"
                  method="POST"
                 onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
             @csrf
             @method('DELETE')
                <button class="btn btn-outline-danger btn-batalkan-pos w-100 mt-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                     Batalkan Transaksi
                </button>
            </form>
            @endcan
        </div>
    </div>
</div>

</div>
@endsection