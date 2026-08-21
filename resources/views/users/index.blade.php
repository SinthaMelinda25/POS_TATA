@extends('layouts.app')

@section('title', 'Users')

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

    .page-heading-users {
        font-weight: 800;
        color: var(--green-darkest);
        margin: 1.8rem 0 1.2rem;
    }

    .btn-create {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
        font-weight: 500;
        border-radius: 8px;
        padding: .5rem 1.2rem;
    }

    .btn-create:hover {
        background-color: var(--green-primary-hover);
        border-color: var(--green-primary-hover);
        color: #fff;
    }

    .search-form-users .form-control {
        border: 1px solid var(--green-soft);
        border-radius: 8px 0 0 8px;
        padding: .55rem .9rem;
    }

    .search-form-users .form-control:focus {
        border-color: var(--green-primary);
        box-shadow: 0 0 0 .2rem rgba(79, 138, 91, .2);
    }

    .search-form-users .btn-outline-secondary {
        border: 1px solid var(--green-soft);
        border-left: none;
        color: var(--green-darkest);
        border-radius: 0 8px 8px 0;
        font-weight: 500;
    }

    .search-form-users .btn-outline-secondary:hover {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
    }

    .table-card-users {
        background-color: #fff;
        border: 1px solid var(--green-soft);
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(51, 98, 60, 0.08);
        padding: .75rem 1rem .25rem;
        margin-bottom: 1rem;
    }

    .green-table-users thead th {
        background-color: var(--green-primary);
        color: #fff;
        border: none;
        font-weight: 500;
    }

    .green-table-users thead tr th:first-child {
        border-top-left-radius: 8px;
    }

    .green-table-users thead tr th:last-child {
        border-top-right-radius: 8px;
    }

    .green-table-users tbody tr:hover {
        background-color: var(--green-pale);
    }

    .green-table-users tbody td,
    .green-table-users tbody th {
        border-color: #e3ece4;
        vertical-align: middle;
    }

    .role-badge {
        background-color: var(--green-pale);
        color: var(--green-darkest);
        font-weight: 600;
        font-size: .78rem;
        padding: .3rem .7rem;
        border-radius: 999px;
        display: inline-block;
    }

    .btn-edit-user {
        background-color: transparent;
        border: 1.5px solid #d9a441;
        color: #d9a441;
        border-radius: 6px;
        font-weight: 500;

    }

    .btn-edit-user:hover {
        background-color: #d9a441;
        color: #fff;
    }

    .btn-delete-user {
        background-color: transparent;
        border: 1.5px solid #a85751;
        color: #a85751;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-delete-user:hover {
        background-color: #a85751;
        color: #fff;
    }

    .aksi-separator {
        color: var(--green-soft);
        margin: 0 4px;
    }

    .green-table-users .pagination .page-link {
        color: var(--green-primary);
        border-color: var(--green-soft);
    }

    .green-table-users .pagination .page-item.active .page-link {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
    }
</style>


<h1 class="page-heading-users">Users</h1>
<a href="{{ route('admin.users.create') }}" class="btn btn-create mb-3">Tambah</a>

<form action="{{ route('admin.users') }}" method="GET" class="mb-3 search-form-users">
    <div class="input-group">
        <input 
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Cari username atau email"
            autocomplete="off"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Cari
        </button>
    </div>
</form>

<div class="table-card-users">
<table class="table green-table-users">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
        <td>{{ $users->firstItem() + $loop->index }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td><span class="role-badge">{{ $user->role->name }}</span></td>
        <td>
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-edit-user">
                Edit
            </a>
           <span class="aksi-separator">||</span>
           <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-delete-user" onclick="return confirm('Yakin hapus user ini?')">Hapus</button>
           </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{ $users->links() }}
@endsection