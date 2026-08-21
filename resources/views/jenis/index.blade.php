@extends('layouts.app')

@section('title', 'Jenis')

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

    .page-heading-jenis {
        font-weight: 800;
        color: var(--green-darkest);
        margin: 1.8rem 0 1.2rem;
    }

    .btn-create-jenis {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
        font-weight: 500;
        border-radius: 8px;
        padding: .5rem 1.2rem;
    }

    .btn-create-jenis:hover {
        background-color: var(--green-primary-hover);
        border-color: var(--green-primary-hover);
        color: #fff;
    }

    .search-form-jenis .form-control {
        border: 1px solid var(--green-soft);
        border-radius: 8px 0 0 8px;
        padding: .55rem .9rem;
    }

    .search-form-jenis .form-control:focus {
        border-color: var(--green-primary);
        box-shadow: 0 0 0 .2rem rgba(79, 138, 91, .2);
    }

    .search-form-jenis .btn-outline-secondary {
        border: 1px solid var(--green-soft);
        border-left: none;
        color: var(--green-darkest);
        border-radius: 0 8px 8px 0;
        font-weight: 500;
    }

    .search-form-jenis .btn-outline-secondary:hover {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
    }

    .table-card-jenis {
        background-color: #fff;
        border: 1px solid var(--green-soft);
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(51, 98, 60, 0.08);
        padding: .75rem 1rem .25rem;
        margin-bottom: 1rem;
    }

    .green-table-jenis thead th {
        background-color: var(--green-primary);
        color: #fff;
        border: none;
        font-weight: 500;
    }

    .green-table-jenis thead tr th:first-child {
        border-top-left-radius: 8px;
    }

    .green-table-jenis thead tr th:last-child {
        border-top-right-radius: 8px;
    }

    .green-table-jenis tbody tr:hover {
        background-color: var(--green-pale);
    }

    .green-table-jenis tbody td,
    .green-table-jenis tbody th {
        border-color: #e3ece4;
        vertical-align: middle;
    }

    

    .btn-edit-jenis {
        background-color: transparent;
        border: 1.5px solid #d9a441;
        color: #d9a441;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-edit-jenis:hover {
        background-color: #d9a441;
        color: #fff;
    }

    .btn-delete-jenis {
        background-color: transparent;
        border: 1.5px solid #a85751;
        color: #a85751;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-delete-jenis:hover {
        background-color: #a85751;
        color: #fff;
    }

    .aksi-separator-jenis {
        color: var(--green-soft);
        margin: 0 4px;
    }

    .green-table-jenis .pagination .page-link {
        color: var(--green-primary);
        border-color: var(--green-soft);
    }

    .green-table-jenis .pagination .page-item.active .page-link {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
    }
</style>

<h1 class="page-heading-jenis">Jenis</h1>
<a href="{{ route('jenis.create') }}" class="btn btn-create-jenis mb-3">Tambah</a>

<form action="{{ route('jenis.index') }}" method="GET" class="mb-3 search-form-jenis">
    <div class="input-group">
        <input 
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Cari nama jenis"
            autocomplete="off"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Cari
        </button>
    </div>
</form>

<div class="table-card-jenis">
<table class="table green-table-jenis">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($jenis as $item)
    <tr>
        <td>{{ $jenis->firstItem() + $loop->index }}</td>
        <td>{{ $item->nama }}</td>
        <td>
            <a href="{{ route('jenis.edit', $item) }}" class="btn btn-sm btn-edit-jenis">
                Edit
            </a>
           <span class="aksi-separator-jenis">||</span>
           <form action="{{ route('jenis.destroy', $item) }}" method="POST" class="d-inline">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-delete-jenis" onclick="return confirm('Yakin hapus jenis ini?')">Hapus</button>
           </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="3" class="text-center text-muted">Data tidak ditemukan</td>
    </tr>
    @endforelse
  </tbody>
</table>
</div>
{{ $jenis->links() }}
@endsection