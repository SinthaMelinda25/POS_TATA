@extends('layouts.app')

@section('title', 'Tambah Jenis')

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
        text-align: center;
    }

    .form-card-jenis {
        background-color: #fff;
        border: 1px solid var(--green-soft);
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(51, 98, 60, 0.08);
        padding: 1.75rem;
        max-width: 560px;
        margin: 0 auto 1.5rem;
    }

    .form-card-jenis .form-label {
        color: var(--green-darkest);
        font-weight: 500;
        font-size: .9rem;
    }

    .form-card-jenis .form-control {
        border: 1px solid var(--green-soft);
        border-radius: 8px;
        padding: .55rem .8rem;
        margin-bottom: 1rem;
    }

    .form-card-jenis .form-control:focus {
        border-color: var(--green-primary);
        box-shadow: 0 0 0 .2rem rgba(79, 138, 91, .2);
    }

    .form-card-jenis .btn-success {
        background-color: var(--green-primary);
        border-color: var(--green-primary);
        color: #fff;
        font-weight: 500;
        border-radius: 8px;
        padding: .5rem 1.4rem;
    }

    .form-card-jenis .btn-success:hover {
        background-color: var(--green-primary-hover);
        border-color: var(--green-primary-hover);
        color: #fff;
    }

    .form-card-jenis .btn-secondary {
        background-color: #f1f3f0;
        border-color: var(--green-soft);
        color: var(--green-darkest);
        font-weight: 500;
        border-radius: 8px;
        padding: .5rem 1.4rem;
    }

    .form-card-jenis .btn-secondary:hover {
        background-color: var(--green-pale);
        border-color: var(--green-primary);
        color: var(--green-darkest);
    }

    .form-card-jenis .invalid-feedback,
    .form-card-jenis .text-danger {
        color: #c0463f !important;
        font-size: .82rem;
    }
</style>

<h4 class="page-heading-jenis">Tambah Jenis</h4>

<div class="form-card-jenis">
<form action="{{ route('jenis.store') }}" method="POST">
    @include('jenis._form')
</form>
</div>
@endsection