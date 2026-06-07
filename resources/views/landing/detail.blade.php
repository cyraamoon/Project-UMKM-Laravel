@extends('layouts.app')

@section('title', $produk->nama_produk . ' - La Brioche')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">

    <div style="margin-bottom: 30px; font-size: 14px; color: #8B7355;">
        <a href="{{ route('landing') }}" style="color: #8B7355; text-decoration: none;">Beranda</a> /
        <a href="{{ route('landing', ['kategori' => $produk->kategori]) }}" style="color: #8B7355; text-decoration: none;">{{ $produk->kategori }}</a> /
        <span style="color: #D4A76A;">{{ $produk->nama_produk }}</span>
    </div>

 
    <div style="background: white; border-radius: 20px; border: 1px solid #E8D5B5; overflow: hidden;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; padding: 30px;">

            <div style="background: #FDF7F0; border-radius: 16px; display: flex; align-items: center; justify-content: center; padding: 20px; min-height: 350px;">
                @if($produk->poto)
                    <img src="{{ asset('storage/'.$produk->poto) }}" alt="{{ $produk->nama_produk }}"
                         style="width: 100%; max-width: 300px; height: 300px; object-fit: cover; border-radius: 16px;">
                @else
                    <div style="text-align: center;">
                        <div style="font-size: 80px; margin-bottom: 10px;">
                            @if($produk->kategori == 'Minuman')
                                🍹
                            @elseif($produk->kategori == 'Main Course')
                                🍽️
                            @elseif($produk->kategori == 'Dessert')
                                🍰
                            @elseif($produk->kategori == 'Appetizer')
                                🍢
                            @else
                                🍽️
                            @endif
                        </div>
                        <p style="color: #8B7355;">Gambar tidak tersedia</p>
                    </div>
                @endif
            </div>

            <div>
                <div style="margin-bottom: 20px;">
                    <span style="display: inline-block; background: #E8D5B5; padding: 4px 12px; border-radius: 20px; font-size: 12px; margin-bottom: 10px;">
                        {{ $produk->kategori }}
                    </span>
                    <h1 style="font-size: 28px; font-weight: bold; color: #5C3D2E; margin-bottom: 10px;">{{ $produk->nama_produk }}</h1>
                </div>

                <div style="margin-bottom: 20px;">
                    <span style="font-size: 28px; font-weight: bold; color: #D4A76A;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                </div>

                <div style="margin-bottom: 20px;">
                    <span style="font-size: 14px; color: #8B7355;">Status Stok:</span>
                    @if($produk->stok > 0)
                        <span style="color: green; font-weight: bold; margin-left: 5px;">✅ Tersedia ({{ $produk->stok }} pcs)</span>
                    @else
                        <span style="color: red; font-weight: bold; margin-left: 5px;">❌ Habis</span>
                    @endif
                </div>

                <div style="margin-bottom: 25px;">
                    <h3 style="font-weight: bold; color: #5C3D2E; margin-bottom: 8px;">Deskripsi Produk</h3>
                    <p style="color: #8B7355; line-height: 1.6;">{{ $produk->deskripsi ?? 'Nikmati kelezatan produk premium dari La Brioche. Dibuat dengan bahan berkualitas dan penuh cinta.' }}</p>
                </div>

                @auth
                    @if($produk->stok > 0)
                        <form action="{{ route('keranjang.tambah', $produk->id) }}" method="POST" style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
                            @csrf
                            <div>
                                <label style="display: block; font-size: 13px; margin-bottom: 5px;">Jumlah</label>
                                <input type="number" name="jumlah" value="1" min="1" max="{{ $produk->stok }}"
                                       style="width: 80px; padding: 10px; border: 1px solid #E8D5B5; border-radius: 8px; text-align: center;">
                            </div>
                            <button type="submit" style="background: #D4A76A; color: white; border: none; padding: 10px 25px; border-radius: 40px; font-weight: bold; cursor: pointer; margin-top: 20px;">
                                🛒 Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <button disabled style="background: gray; color: white; padding: 10px 25px; border-radius: 40px; border: none; margin-bottom: 20px;">
                            Stok Habis
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" style="display: inline-block; background: #D4A76A; color: white; padding: 10px 25px; border-radius: 40px; text-decoration: none; margin-bottom: 20px;">
                        Login untuk Membeli
                    </a>
                @endauth

                <a href="{{ route('landing') }}" style="color: #D4A76A; text-decoration: none;">← Kembali ke Menu</a>
            </div>
        </div>
    </div>

    @if(isset($rekomendasi) && $rekomendasi->count() > 0)
    <div style="margin-top: 50px;">
        <h2 style="font-size: 24px; font-weight: bold; color: #5C3D2E; margin-bottom: 20px;">✨ Produk Lainnya</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
            @foreach($rekomendasi as $r)
            <a href="{{ route('produk.detail', $r->id) }}" style="background: white; border-radius: 12px; border: 1px solid #E8D5B5; overflow: hidden; text-decoration: none; transition: all 0.3s;">
                <div style="height: 150px; background: #FDF7F0; display: flex; align-items: center; justify-content: center;">
                    @if($r->poto)
                        <img src="{{ asset('storage/'.$r->poto) }}" alt="{{ $r->nama_produk }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="font-size: 50px;">
                            @if($r->kategori == 'Minuman') 🍹
                            @elseif($r->kategori == 'Main Course') 🍽️
                            @elseif($r->kategori == 'Dessert') 🍰
                            @else 🍢 @endif
                        </div>
                    @endif
                </div>
                <div style="padding: 12px;">
                    <h3 style="font-weight: bold; color: #5C3D2E; margin-bottom: 5px;">{{ $r->nama_produk }}</h3>
                    <p style="color: #D4A76A; font-weight: bold;">Rp {{ number_format($r->harga, 0, ',', '.') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
