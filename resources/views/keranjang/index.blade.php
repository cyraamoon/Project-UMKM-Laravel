@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 50px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h1 style="color: #5C3D2E; margin-bottom: 20px;">🛒 Keranjang Belanja</h1>

    @php $keranjang = session()->get('keranjang', []); @endphp

    @if(count($keranjang) > 0)
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="background: #FDF7F0;">
                <th style="padding: 12px; text-align: left;">Produk</th>
                <th style="padding: 12px; text-align: left;">Harga</th>
                <th style="padding: 12px; text-align: left;">Jumlah</th>
                <th style="padding: 12px; text-align: left;">Subtotal</th>
                <th style="padding: 12px;"></th>
            </tr>
            @php $total = 0; @endphp
            @foreach($keranjang as $id => $item)
            @php
                $subtotal = $item['harga'] * $item['jumlah'];
                $total += $subtotal;
            @endphp
            <tr style="border-bottom: 1px solid #E8D5B5;">
                <td style="padding: 12px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        @if(isset($item['foto']) && $item['foto'])
                            <img src="{{ asset('storage/'.$item['foto']) }}" style="width: 44px; height: 44px; border-radius: 10px; object-fit: cover;">
                        @else
                            <div style="width: 44px; height: 44px; background: #E8D5B5; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                                @if(($item['kategori'] ?? '') == 'Minuman')
                                    🍹
                                @elseif(($item['kategori'] ?? '') == 'Main Course')
                                    🍽️
                                @elseif(($item['kategori'] ?? '') == 'Dessert')
                                    🍰
                                @elseif(($item['kategori'] ?? '') == 'Appetizer')
                                    🍢
                                @else
                                    🍽️
                                @endif
                            </div>
                        @endif
                        <span>{{ $item['nama'] }}</span>
                    </div>
                </td>
                <td style="padding: 12px;">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                <td style="padding: 12px;">
                    <form action="{{ route('keranjang.update', $id) }}" method="POST" style="display: flex; gap: 5px;">
                        @csrf
                        @method('PUT')
                        <input type="number" name="jumlah" value="{{ $item['jumlah'] }}" min="1" style="width: 60px; padding: 5px; border: 1px solid #E8D5B5; border-radius: 5px;">
                        <button type="submit" style="background: #D4A76A; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Update</button>
                    </form>
                </td>
                <td style="padding: 12px;">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                <td style="padding: 12px;">
                    <form action="{{ route('keranjang.hapus', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: #ff4444; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr style="background: #FDF7F0; font-weight: bold;">
                <td colspan="3" style="padding: 12px; text-align: right;">Total:</td>
                <td style="padding: 12px;">Rp {{ number_format($total, 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </table>

        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #E8D5B5;">
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; margin-bottom: 5px;">Metode Pembayaran</label>
                        <select name="metode_bayar" style="width: 100%; padding: 8px; border: 1px solid #E8D5B5; border-radius: 5px;">
                            <option value="Transfer Bank">🏦 Transfer Bank</option>
                            <option value="QRIS">📱 QRIS</option>
                            <option value="COD">💵 COD</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 5px;">Metode Pengiriman</label>
                        <select name="metode_kirim" style="width: 100%; padding: 8px; border: 1px solid #E8D5B5; border-radius: 5px;">
                            <option value="Ambil Sendiri">🏪 Ambil Sendiri</option>
                            <option value="GoSend">🛵 GoSend</option>
                            <option value="GrabExpress">🚗 GrabExpress</option>
                        </select>
                    </div>
                </div>
                <button type="submit" style="background: #D4A76A; color: white; padding: 12px; border: none; border-radius: 8px; width: 100%; font-weight: bold; cursor: pointer;">✅ Checkout Sekarang</button>
            </form>

            <div style="margin-top: 10px; text-align: center;">
                <form action="{{ route('keranjang.kosongkan') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none; color: #999; cursor: pointer;">🗑️ Kosongkan Keranjang</button>
                </form>
            </div>
        </div>
    @else
        <div style="text-align: center; padding: 50px;">
            <div style="font-size: 50px;">🛒</div>
            <h3>Keranjang Kosong</h3>
            <p style="color: #999;">Belum ada produk di keranjang Anda</p>
            <a href="{{ route('landing') }}" style="background: #D4A76A; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block;">Mulai Belanja</a>
        </div>
    @endif
</div>
@endsection
