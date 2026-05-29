<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::where('stok', '>', 0)->get();
        $kategoris = Produk::select('kategori')->distinct()->get();
        return view('landing', compact('produks', 'kategoris'));
    }

    public function detail($id)
{
    $produk = Produk::findOrFail($id);

    // Ambil rekomendasi produk dari kategori yang sama
    $rekomendasi = Produk::where('kategori', $produk->kategori)
        ->where('id', '!=', $id)
        ->where('stok', '>', 0)
        ->limit(4)
        ->get();

    return view('landing.detail', compact('produk', 'rekomendasi'));
}

    public function getByKategori($kategori)
    {
        $produks = Produk::where('kategori', $kategori)->where('stok', '>', 0)->get();
        return response()->json(['success' => true, 'produks' => $produks]);
    }

    // Tampilkan keranjang
    public function viewCart()
    {
        $cart = session()->get('keranjang', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }
        return view('keranjang.index', compact('cart', 'total'));
    }

    // Tambah ke keranjang (sesuai dengan KeranjangController)
    public function addToCart(Request $request, $id)
    {
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Login dulu untuk menambah ke keranjang!'], 401);
            }
            return redirect()->route('login')->with('error', 'Login dulu untuk menambah ke keranjang!');
        }

        $produk = Produk::findOrFail($id);
        $keranjang = session()->get('keranjang', []);
        $jumlah = (int) ($request->jumlah ?? 1);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah'] += $jumlah;
        } else {
            $keranjang[$id] = [
                'id'       => $produk->id,
                'nama'     => $produk->nama_produk,
                'harga'    => $produk->harga,
                'kategori' => $produk->kategori,
                'foto'     => $produk->poto,
                'jumlah'   => $jumlah,
            ];
        }

        // Batasi tidak melebihi stok
        if ($keranjang[$id]['jumlah'] > $produk->stok) {
            $keranjang[$id]['jumlah'] = $produk->stok;
        }

        session()->put('keranjang', $keranjang);

        $cartCount = array_sum(array_column($keranjang, 'jumlah'));

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $produk->nama_produk . ' ditambahkan ke keranjang!',
                'cart_count' => $cartCount
            ]);
        }

        return redirect()->back()->with('success', $produk->nama_produk . ' ditambahkan ke keranjang!');
    }

    // Update keranjang
    public function updateCart(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            $produk = Produk::find($id);
            $newQuantity = (int) $request->jumlah;
            if ($produk && $newQuantity <= $produk->stok) {
                $keranjang[$id]['jumlah'] = $newQuantity;
            } else {
                $keranjang[$id]['jumlah'] = $produk ? $produk->stok : 1;
            }
            session()->put('keranjang', $keranjang);
        }

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->back()->with('success', 'Keranjang diperbarui!');
    }

    // Hapus dari keranjang
    public function removeFromCart($id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    // Kosongkan keranjang
    public function clearCart()
    {
        session()->forget('keranjang');
        return redirect()->back()->with('success', 'Keranjang dikosongkan!');
    }

    // Dapatkan jumlah item di keranjang (untuk badge)
    public function getCartCount()
    {
        $keranjang = session()->get('keranjang', []);
        $count = array_sum(array_column($keranjang, 'jumlah'));
        return response()->json(['count' => $count]);
    }
}
