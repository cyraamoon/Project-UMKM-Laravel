@extends('layouts.admin')
@section('page-title', 'Data Transaksi')

@section('content')
<div class="card">
    <div class="card-header"><h2 class="card-title">🧾 Data Transaksi</h2></div>
    <div class="table-wrapper">
        <table class="data-table">
            <thead><tr><th>ID</th><th>Pelanggan</th><th>Tanggal</th><th>Total</th><th>Metode Bayar</th><th>Metode Kirim</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($transaksis as $t)
                <tr>
                    <td>#{{ $t->id }}</td>
                    <td>{{ $t->pelanggan->nama_lengkap ?? $t->pelanggan->username ?? '-' }}</td>
                    <td>{{ $t->created_at->format('d M Y') }}</td>
                    <td style="color: var(--gold); font-weight: 600;">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $t->metode_bayar }}</td>
                    <td>{{ $t->metode_kirim }}</td>
                    <td>
                        <form action="{{ route('admin.transaksi.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin hapus transaksi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align: center; padding: 40px;">Belum ada transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding: 12px 24px; border-top: 1px solid var(--brown-light);">{{ $transaksis->links() }}</div>
</div>
@endsection
