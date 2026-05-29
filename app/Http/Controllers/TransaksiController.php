<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi user
    public function index()
    {
        $transaksis = Transaksi::where('user_id', Auth::id())->latest()->paginate(10);
        return view('transaksi.index', compact('transaksis'));
    }

    // Menyimpan transaksi baru dari keranjang
    public function store(Request $request)
    {
        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong!');
        }

        // Hitung total harga
        $total = 0;
        $items = [];
        foreach ($keranjang as $id => $item) {
            $subtotal = $item['harga'] * $item['jumlah'];
            $total += $subtotal;
            $items[] = [
                'produk_id' => $id,
                'nama_produk' => $item['nama'],
                'harga' => $item['harga'],
                'jumlah' => $item['jumlah'],
                'subtotal' => $subtotal
            ];
        }

        // Simpan transaksi
        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'total_harga' => $total,
            'metode_bayar' => $request->metode_bayar,
            'metode_kirim' => $request->metode_kirim,
            'items' => json_encode($items),
        ]);

        // Kosongkan keranjang
        session()->forget('keranjang');

        return redirect()->route('transaksi.invoice', $transaksi->id)->with('success', 'Transaksi berhasil!');
    }

    // Menampilkan invoice
    public function invoice($id)
    {
        $transaksi = Transaksi::with('pelanggan')->findOrFail($id);

        // Pastikan user hanya bisa melihat transaksinya sendiri
        if ($transaksi->user_id != Auth::id() && Auth::user()->role != 'admin') {
            abort(403);
        }

        $items = json_decode($transaksi->items, true);
        return view('transaksi.invoice', compact('transaksi', 'items'));
    }
}
