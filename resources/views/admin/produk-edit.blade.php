@extends('layouts.admin')
@section('page-title', 'Edit Produk')

@section('content')
<div style="max-width: 560px; margin: 0 auto;">
    <div class="card">
        <div class="card-header"><h2 class="card-title">✏️ Edit Produk</h2></div>
        <div class="card-body">
            <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group"><label class="form-label">Nama Produk</label><input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required></div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div class="form-group"><label class="form-label">Harga (Rp)</label><input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required></div>
                    <div class="form-group"><label class="form-label">Stok</label><input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-control">
                        <option value="Minuman" {{ $produk->kategori == 'Minuman' ? 'selected' : '' }}>🍹 Minuman</option>
                        <option value="Main Course" {{ $produk->kategori == 'Main Course' ? 'selected' : '' }}>🍽️ Main Course</option>
                        <option value="Dessert" {{ $produk->kategori == 'Dessert' ? 'selected' : '' }}>🍰 Dessert</option>
                        <option value="Appetizer" {{ $produk->kategori == 'Appetizer' ? 'selected' : '' }}>🍢 Appetizer</option>
                    </select>
                    </div>
                <div class="form-group">
                    <label class="form-label">Foto Produk</label>
                    @if($produk->poto)<div style="margin-bottom: 8px;"><img src="{{ asset('storage/'.$produk->poto) }}" style="width: 70px; height: 70px; border-radius: 10px;"></div>@endif
                    <input type="file" name="poto" class="form-control" accept="image/*">
                    <small style="color: var(--brown-warm);">Kosongkan jika tidak ingin mengubah foto</small>
                </div>
                <div class="form-group"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3">{{ $produk->deskripsi }}</textarea></div>
                <div style="display: flex; gap: 12px; margin-top: 20px;">
                    <button type="submit" class="btn-primary"><i class="ti ti-device-floppy"></i> Simpan Perubahan</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn-outline" style="padding: 10px 24px;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
