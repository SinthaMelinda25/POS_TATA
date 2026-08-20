@csrf

<div class="mb-3">
    <label class="form-label">Nama Jenis</label>
    <input type="text" name="nama"
           class="form-control @error('nama') is-invalid @enderror"
           value="{{ old('nama', $jenis->nama ?? '') }}">
    @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<button class="btn btn-success">Simpan</button>
<a href="{{ route('jenis.index') }}" class="btn btn-secondary">Kembali</a>