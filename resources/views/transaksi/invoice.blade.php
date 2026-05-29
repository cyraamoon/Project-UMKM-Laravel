<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $transaksi->id }} - La Brioche</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Arial', sans-serif;
            background: #FFF9F5;
            padding: 40px;
        }
        .invoice {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            padding: 30px;
            border: 1px solid #E8D5B5;
        }
        .invoice-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #D4A76A;
            margin-bottom: 20px;
        }
        .invoice-logo { font-size: 28px; font-weight: bold; color: #5C3D2E; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 5px; border-bottom: 1px solid #E8D5B5; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #E8D5B5; }
        th { background: #FDF7F0; }
        .total { font-weight: bold; font-size: 18px; color: #D4A76A; text-align: right; }
        .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #E8D5B5; font-size: 11px; }
        @media print { body { background: white; padding: 0; } .no-print { display: none; } }
        .btn-print {
            background: #D4A76A;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <button onclick="window.print()" class="btn-print no-print">🖨️ Cetak Invoice</button>
    </div>

    <div class="invoice">
        <div class="invoice-header">
            <div class="invoice-logo">🥐 La Brioche</div>
            <div>Bakery & Coffee</div>
        </div>

        <div class="info-row"><span>No. Invoice</span><strong>#INV-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</strong></div>
        <div class="info-row"><span>Tanggal</span><strong>{{ $transaksi->created_at->format('d F Y, H:i') }}</strong></div>
        <div class="info-row"><span>Pelanggan</span><strong>{{ Auth::user()->nama_lengkap ?? Auth::user()->username }}</strong></div>
        <div class="info-row"><span>Metode Bayar</span><strong>{{ $transaksi->metode_bayar }}</strong></div>
        <div class="info-row"><span>Metode Kirim</span><strong>{{ $transaksi->metode_kirim }}</strong></div>

        <table>
            <thead><tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr></thead>
            <tbody>
                @php $items = json_decode($transaksi->items, true); @endphp
                @foreach($items as $item)
                <tr>
                    <td>{{ $item['nama_produk'] }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">Total: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</div>

        <div class="footer">Terima kasih telah berbelanja di La Brioche! 🥐</div>
    </div>
</body>
</html>
