<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        return view('keranjang.index', compact('keranjang'));
    }

    public function tambah(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
        } else {
            $keranjang[$id] = [
                'id' => $produk->id,
                'nama' => $produk->nama_produk,
                'harga' => $produk->harga,
                'kategori' => $produk->kategori,
                'foto' => $produk->poto,
                'jumlah' => 1,
            ];
        }

        session()->put('keranjang', $keranjang);
        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] = $request->jumlah;
            session()->put('keranjang', $keranjang);
        }
        return redirect()->route('keranjang.index')->with('success', 'Keranjang diupdate');
    }

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }
        return redirect()->route('keranjang.index')->with('success', 'Produk dihapus');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');
        return redirect()->route('keranjang.index')->with('success', 'Keranjang dikosongkan');
    }
}
