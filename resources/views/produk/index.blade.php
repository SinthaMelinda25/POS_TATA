@extends("layouts.app")

@section('title', 'Produk')

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

    .page-heading-produk {
        font-weight: 800;
        color: var(--green-darkest);
        margin: 1.8rem 0 1.2rem;
    }

    .btn-create-produk {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
        font-weight: 500;
        border-radius: 8px;
        padding: .5rem 1.2rem;
    }

    .btn-create-produk:hover {
        background-color: var(--green-primary-hover);
        border-color: var(--green-primary-hover);
        color: #fff;
    }

    .search-form-produk .form-control {
        border: 1px solid var(--green-soft);
        border-radius: 8px 0 0 8px;
        padding: .55rem .9rem;
    }

    .search-form-produk .form-control:focus {
        border-color: var(--green-primary);
        box-shadow: 0 0 0 .2rem rgba(79, 138, 91, .2);
    }

    .search-form-produk .btn-outline-secondary {
        border: 1px solid var(--green-soft);
        border-left: none;
        color: var(--green-darkest);
        border-radius: 0 8px 8px 0;
        font-weight: 500;
    }

    .search-form-produk .btn-outline-secondary:hover {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
    }

    .table-card-produk {
        background-color: #fff;
        border: 1px solid var(--green-soft);
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(51, 98, 60, 0.08);
        padding: .75rem 1rem .25rem;
        margin-bottom: 1rem;
        overflow-x: auto;
    }

    .green-table-produk thead th {
        background-color: var(--green-primary);
        color: #fff;
        border: none;
        font-weight: 500;
        white-space: nowrap;
    }

    .green-table-produk thead tr th:first-child {
        border-top-left-radius: 8px;
    }

    .green-table-produk thead tr th:last-child {
        border-top-right-radius: 8px;
    }

    .green-table-produk tbody tr:hover {
        background-color: var(--green-pale);
    }

    .green-table-produk tbody td,
    .green-table-produk tbody th {
        border-color: #e3ece4;
    }

    .green-table-produk .img-thumbnail {
        border: 1px solid var(--green-soft);
        border-radius: 8px;
    }

    .harga-jual {
        color: var(--green-darkest);
        font-weight: 600;
    }

    .stok-badge {
        background-color: var(--green-pale);
        color: var(--green-darkest);
        font-weight: 600;
        font-size: .78rem;
        padding: .3rem .7rem;
        border-radius: 999px;
        display: inline-block;
    }

    .btn-edit-produk {
        background-color: transparent;
        border: 1.5px solid #d9a441;
        color: #d9a441;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-edit-produk:hover {
        background-color: #d9a441;
        color: #fff;
    }

    .btn-delete-produk {
        background-color: transparent;
        border: 1.5px solid #a85751;
        color: #a85751;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-delete-produk:hover {
        background-color: #a85751;
        color: #fff;
    }

    .aksi-separator-produk {
        color: var(--green-soft);
    }

    .green-table-produk .pagination .page-link {
        color: var(--green-primary);
        border-color: var(--green-soft);
    }

    .green-table-produk .pagination .page-item.active .page-link {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
    }
</style>

<h1 class="page-heading-produk">Produk</h1>

@can('create', App\Models\Produk::class)
<a href="{{ route('produk.create')}}" method="GET" class="btn btn-create-produk mb-3">Create</a>
@endcan

<form action="{{ route('produk.index') }}" method="GET" class="mb-3 search-form-produk">
    <div class="input-group">
        <input 
            type="text"
            name="search"
            value=""
            class="form-control"
            placeholder="Search nama produk"
            autocomplete="off"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<div class="table-card-produk">
<table class="table align-middle green-table-produk">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">User</th>
      <th scope="col">Foto</th>
      <th scope="col">Nama</th>
      <th scope="col">Jenis</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Harga Jual</th>
      <th scope="col">Stok</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($products as $product)
    <tr>
      <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
      <td>{{ $product->user->name }}</td>
      <td>
        <img src="{{ asset('storage/'.$product->foto) }}"
                  width="100"
                  class="img-thumbnail">
      </td>
      <td>{{ $product->nama }}</td>
      
      <!-- Selesai Diperbaiki: Menampilkan Nama Jenis Produk yang sesungguhnya di kolom Jenis -->
      <td>{{ $product->jenis->nama ?? 'Tidak Ada Jenis' }}</td>
      
      <td>Rp{{ number_format($product->harga_beli, 0, ',', '.') }}</td>
      <td class="harga-jual">Rp{{ number_format($product->harga_jual, 0, ',', '.') }}</td>
      <td><span class="stok-badge">{{ $product->stok }}</span></td>
      
      <td>
        <div class="d-flex align-items-center gap-1">
          @can('update', $product)
            <a href="{{ route('produk.edit' , $product) }}" class="btn btn-edit-produk">Edit</a>
          @endcan
          
          <span class="aksi-separator-produk">||</span>
          
          @can('delete', $product)
            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline m-0">
                @csrf
                @method('DELETE')
                <button class="btn btn-delete-produk" onclick="return confirm('Apakah anda yakin akan menghapus user ini?')">
                    Hapus
                </button> 
            </form>
          @endcan
        </div>
      </td>
    </tr>
    @empty
    <tr>
        <!-- Selesai Diperbaiki: Mengubah colspan ke 9 karena jumlah total kolom sekarang ada 9 -->
        <td colspan="9" class="text-center"><h1>Data tidak tersedia</h1></td>
    </tr>
    @endforelse
  </tbody>
</table>
</div>

{{ $products->links() }}

@endsection
