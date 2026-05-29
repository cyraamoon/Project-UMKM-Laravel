<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori');
        $query = Produk::query();

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $produk = $query->latest()->get();
        $kategoriList = Produk::distinct()->pluck('kategori');

        // ========== STATISTIK DINAMIS ==========
        $totalProduk = Produk::count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        $rataRating = 4.9;
        $totalTransaksi = Transaksi::count();

        // ========== TESTIMONIALS ==========
        $testimonials = Testimonial::with('user')
            ->where('status', 'approved')
            ->latest()
            ->take(4)
            ->get();

        // ========== KIRIM KE VIEW ==========
        return view('landing.index', compact(
            'produk',
            'kategori',
            'kategoriList',
            'totalProduk',
            'totalPelanggan',
            'rataRating',
            'totalTransaksi',
            'testimonials'
        ));
    }
}
