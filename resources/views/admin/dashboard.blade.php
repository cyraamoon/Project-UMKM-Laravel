@extends('layouts.admin')
@section('page-title', 'Dashboard Produk')

@section('content')
<div class="stat-grid">
    <div class="stat-card"><div class="stat-label">Total Produk</div><div class="stat-value">{{ $totalProduk }}</div></div>
    <div class="stat-card"><div class="stat-label">Total Transaksi</div><div class="stat-value">{{ $totalTransaksi }}</div></div>
    <div class="stat-card"><div class="stat-label">Total Pelanggan</div><div class="stat-value">{{ $totalPelanggan }}</div></div>
</div>

<div style="display: grid; grid-template-columns: 360px 1fr; gap: 24px;">
    {{-- FORM TAMBAH PRODUK --}}
    <div class="card">
        <div class="card-header"><h2 class="card-title">➕ Tambah Produk</h2></div>
        <div class="card-body">
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group"><label class="form-label">Nama Produk</label><input type="text" name="nama_produk" class="form-control" required></div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div class="form-group"><label class="form-label">Harga (Rp)</label><input type="number" name="harga" class="form-control" required></div>
                    <div class="form-group"><label class="form-label">Stok</label><input type="number" name="stok" class="form-control" required></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                   <select name="kategori" class="form-control" required>
                        <option value="Minuman">🍹 Minuman</option>
                        <option value="Main Course">🍽️ Main Course</option>
                        <option value="Dessert">🍰 Dessert</option>
                        <option value="Appetizer">🍢 Appetizer</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label">Foto Produk</label><input type="file" name="poto" class="form-control" accept="image/*"></div>
                <div class="form-group"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3"></textarea></div>
                <button type="submit" class="btn-primary" style="width: 100%;"><i class="ti ti-device-floppy"></i> Simpan Produk</button>
            </form>
        </div>
    </div>

    {{-- TABEL PRODUK --}}
    <div class="card">
        <div class="card-header"><h2 class="card-title">📦 Data Produk</h2></div>
        <div class="table-wrapper">
            <table class="data-table">
                <thead><tr><th>Foto</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse($produk as $p)
                    <tr>
                        <td>
                            @if($p->poto)
                                <img src="{{ asset('storage/'.$p->poto) }}" class="product-img">
                            @else
                                <div class="product-img" style="display: flex; align-items: center; justify-content: center;">{{ $p->kategori === 'Minuman' ? '☕' : ($p->kategori === 'Pastry' ? '🥐' : '🍞') }}</div>
                            @endif
                        </td>
                        <td style="font-weight: 500;">{{ $p->nama_produk }}</td>
                        <td><span class="pill">{{ $p->kategori }}</span></td>
                        <td style="color: var(--gold); font-weight: 600;">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td>{{ $p->stok }}</td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('admin.produk.edit', $p->id) }}" class="btn-outline"><i class="ti ti-edit"></i> Edit</a>
                                <form action="{{ route('admin.produk.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger"><i class="ti ti-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align: center; padding: 40px;">Belum ada produk. Silakan tambah produk baru.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="padding: 12px 24px; border-top: 1px solid var(--brown-light);">{{ $produk->links() }}</div>
    </div>
</div>
@endsection
