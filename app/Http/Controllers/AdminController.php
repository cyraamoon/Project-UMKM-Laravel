<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $produk = Produk::latest()->paginate(10);
        $totalProduk = Produk::count();
        $totalTransaksi = Transaksi::count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();

        return view('admin.dashboard', compact('produk', 'totalProduk', 'totalTransaksi', 'totalPelanggan'));
    }

    // TAMBAH PRODUK - VERSI PALAMING SIMPLE
   public function storeProduk(Request $request)
{
    $path = null;
    if ($request->hasFile('poto')) {
        $path = $request->file('poto')->store('produk', 'public');
    }

    Produk::create([
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'kategori' => $request->kategori,
        'deskripsi' => $request->deskripsi,
        'poto' => $path,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan!');
}

    public function editProduk($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk-edit', compact('produk'));
    }

    public function updateProduk(Request $request, $id)
{
    $produk = Produk::findOrFail($id);

    $data = $request->only(['nama_produk', 'harga', 'stok', 'kategori', 'deskripsi']);

    if ($request->hasFile('poto')) {
        if ($produk->poto) {
            Storage::disk('public')->delete($produk->poto);
        }
        $data['poto'] = $request->file('poto')->store('produk', 'public');
    }

    $produk->update($data);

    return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil diupdate!');
}

    public function destroyProduk($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus!');
    }

    public function transaksi()
    {
        $transaksis = Transaksi::with('pelanggan')->latest()->paginate(15);
        return view('admin.transaksi', compact('transaksis'));
    }

    public function destroyTransaksi($id)
    {
        Transaksi::findOrFail($id)->delete();
        return redirect()->route('admin.transaksi')->with('success', 'Transaksi berhasil dihapus!');
    }

    public function pelanggan()
    {
        $pelanggan = User::where('role', 'pelanggan')->latest()->paginate(15);
        return view('admin.pelanggan', compact('pelanggan'));
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->update(['password' => Hash::make('12345678')]);
        return redirect()->route('admin.pelanggan')->with('success', 'Password berhasil direset!');
    }
}
