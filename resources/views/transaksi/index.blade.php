@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container" style="max-width: 1000px; margin: 50px auto; padding: 20px;">
    <h1 style="color: #5C3D2E; margin-bottom: 20px;">📋 Riwayat Transaksi</h1>

    @if($transaksis->count() > 0)
        @foreach($transaksis as $t)
        <div style="background: white; border-radius: 10px; border: 1px solid #E8D5B5; padding: 15px; margin-bottom: 15px;">
            <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                <div>
                    <p style="color: #999; font-size: 12px;">{{ $t->created_at->format('d F Y, H:i') }}</p>
                    <p style="font-weight: bold; font-size: 18px;">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</p>
                    <p>{{ $t->metode_bayar }} · {{ $t->metode_kirim }}</p>
                </div>
                <a href="{{ route('transaksi.invoice', $t->id) }}" style="background: #D4A76A; color: white; padding: 8px 15px; border-radius: 8px; text-decoration: none;">🖨️ Invoice</a>
            </div>
        </div>
        @endforeach
        {{ $transaksis->links() }}
    @else
        <div style="text-align: center; padding: 50px;">
            <div style="font-size: 50px;">📦</div>
            <p>Belum ada transaksi</p>
            <a href="{{ route('landing') }}" style="background: #D4A76A; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none;">Mulai Belanja</a>
        </div>
    @endif
</div>
@endsection
