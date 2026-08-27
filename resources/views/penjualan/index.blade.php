@extends('layouts.app')

@section('title', 'Penjualan')

@include('layouts.navbar')

@section('content')

<style>
    :root {
        --green-darkest: #33623c;
        --green-primary:  #4f8a5b;
        --green-primary-hover: #3f7049;
        --green-soft:     #9fc7a8;
        --green-pale:     #eef5ef;
    }

    .page-heading-penjualan {
        font-weight: 800;
        color: var(--green-darkest);
        margin: 1.8rem 0 1.2rem;
    }

    .btn-create-penjualan {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
        font-weight: 500;
        border-radius: 8px;
        padding: .5rem 1.2rem;
    }

    .btn-create-penjualan:hover {
        background-color: var(--green-primary-hover);
        border-color: var(--green-primary-hover);
        color: #fff;
    }

    .search-form-penjualan .form-control {
        border: 1px solid var(--green-soft);
        border-radius: 8px 0 0 8px;
        padding: .55rem .9rem;
    }

    .search-form-penjualan .form-control:focus {
        border-color: var(--green-primary);
        box-shadow: 0 0 0 .2rem rgba(79, 138, 91, .2);
    }

    .search-form-penjualan .btn-outline-secondary {
        border: 1px solid var(--green-soft);
        border-left: none;
        color: var(--green-darkest);
        border-radius: 0 8px 8px 0;
        font-weight: 500;
    }

    .search-form-penjualan .btn-outline-secondary:hover {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
    }

    .table-card-penjualan {
        background-color: #fff;
        border: 1px solid var(--green-soft);
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(51, 98, 60, 0.08);
        padding: .75rem 1rem .25rem;
        margin-bottom: 1rem;
        overflow-x: auto;
    }

    .green-table-penjualan thead th {
        background-color: var(--green-primary);
        color: #fff;
        border: none;
        font-weight: 500;
        white-space: nowrap;
    }

    .green-table-penjualan thead tr th:first-child {
        border-top-left-radius: 8px;
    }

    .green-table-penjualan thead tr th:last-child {
        border-top-right-radius: 8px;
    }

    .green-table-penjualan tbody tr:hover {
        background-color: var(--green-pale);
    }

    .green-table-penjualan tbody td,
    .green-table-penjualan tbody th {
        border-color: #e3ece4;
    }

    .green-table-penjualan tbody th {
    font-weight: 400;
}

    .total-bayar {
        color: var(--green-darkest);
        font-weight: 700;
    }

    .metode-badge {
        background-color: var(--green-pale);
        color: var(--green-darkest);
        font-weight: 600;
        font-size: .78rem;
        padding: .3rem .7rem;
        border-radius: 999px;
        display: inline-block;
    }

    .status-badge {
        font-weight: 600;
        font-size: .78rem;
        padding: .3rem .7rem;
        border-radius: 999px;
        display: inline-block;
    }

    .status-badge.status-lunas,
    .status-badge.status-selesai {
        background-color: #e4f2e6;
        color: #2f7d3c;
    }

    .status-badge.status-pending,
    .status-badge.status-menunggu {
        background-color: #fbf1de;
        color: #a06b0f;
    }

    .status-badge.status-batal,
    .status-badge.status-dibatalkan {
        background-color: #fbeae8;
        color: #b3392f;
    }

   .btn-detail-penjualan {
    background-color: transparent;
    border: 1.5px solid var(--green-primary);
    color: var(--green-primary);
    border-radius: 6px;
    font-weight: 500;
}

.btn-detail-penjualan:hover {
    background-color: var(--green-primary);
    color: #fff;
}

.btn-edit-penjualan {
    background-color: transparent;
    border: 1.5px solid #d9a441;
    color: #d9a441;
    border-radius: 6px;
    font-weight: 500;
}

.btn-edit-penjualan:hover {
    background-color: #d9a441;
    color: #fff;
}

.btn-delete-penjualan {
    background-color: transparent;
    border: 1.5px solid #c0463f;
    color: #c0463f;
    border-radius: 6px;
    font-weight: 500;
}

.btn-delete-penjualan:hover {
    background-color: #c0463f;
    color: #fff;
}

.green-table-penjualan td form {
    margin: 0;
    display: inline-flex;
    align-items: center;
}
    .aksi-separator-penjualan {
        color: var(--green-soft);
    }

    .green-table-penjualan .pagination .page-link {
        color: var(--green-primary);
        border-color: var(--green-soft);
    }

    .green-table-penjualan .pagination .page-item.active .page-link {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
    }
</style>


@if (session('errors'))
<div class="alert alert-danger">
    {{ session('errors') }}
</div>
@endif

<h1 class="page-heading-penjualan">Penjualan</h1>

<a href="{{ route('penjualan.create') }}" class="btn btn-create-penjualan mb-3">Tambah</a>

<form action="{{ route('penjualan.index') }}" method="GET" class="mb-3 search-form-penjualan">
    <div class="input-group">
        <input 
            type="text"
            name="search"
            value="{{ request()->search }}"
            class="form-control"
            placeholder="Cari Kasir"
            autocomplete="off"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Cari
        </button>
    </div>
</form>

<div class="table-card-penjualan">
<table class="table green-table-penjualan">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Tanggal Transaksi</th>
      <th scope="col">Kasir</th>
      <th scope="col">Total Pembayaran</th>
      <th scope="col">Metode Pembayaran</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($sales as $sale )
    <tr>
      <th scope="row">{{ $sales->firstItem() + $loop->index }}</th>
      <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
      <td>{{ $sale->user->name }}</td>
      <td class="total-bayar">Rp{{ number_format($sale->total_pembayaran, 0, ',', '.') }}</td>
      <td><span class="metode-badge">{{ $sale->metode_pembayaran }}</span></td>
      <td><span class="status-badge status-{{ strtolower($sale->status) }}">{{ $sale->status }}</span></td>
    <td class="d-flex align-items-center gap-1">
       <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-detail-penjualan">Detail</a>
        @can('view', $sale)
        <span class="aksi-separator-penjualan">||</span>
        <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-edit-penjualan">Edit</a>
        @endcan
        @can('delete', $sale)
        <span class="aksi-separator-penjualan">||</span>
        <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-delete-penjualan" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                Hapus
            </button>
        </form>
        @endcan
    </td>
    </tr>
    @empty
    <tr>
        <td colspan="6">Data tidak ditemukan</td>
    </tr>
    @endforelse
</tbody>
</table>
</div>
{{ $sales->links() }}
@endsection