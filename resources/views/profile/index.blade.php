@extends('layouts.app')

@section('title', 'Profil Saya - La Brioche')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 24px;">
    <div style="margin-bottom: 32px;">
        <h1 style="font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: #5C3D2E; margin-bottom: 8px;">
            👤 Profil Saya
        </h1>
        <p style="color: #8B7355;">Kelola informasi akun dan lihat riwayat belanja Anda</p>
    </div>

    <div style="display: grid; grid-template-columns: 320px 1fr; gap: 28px;">

     
        <div style="background: white; border-radius: 20px; border: 1px solid #E8D5B5; overflow: hidden; height: fit-content;">
            <div style="background: linear-gradient(135deg, #D4A76A, #C49A5C); padding: 24px; text-align: center;">
                <div style="position: relative; width: 100px; height: 100px; margin: 0 auto;">
                    @if($user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}"
                             style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid white; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    @else
                        <div style="width: 100px; height: 100px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 48px; border: 3px solid white; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                            👤
                        </div>
                    @endif
                </div>
                <h3 style="color: white; font-weight: bold; font-size: 18px; margin-top: 12px;">{{ $user->nama_lengkap ?? $user->username }}</h3>
                <p style="color: rgba(255,255,255,0.8); font-size: 12px; margin-top: 4px;">{{ $user->email }}</p>
            </div>

            <div style="padding: 20px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #E8D5B5;">
                    <span style="font-size: 20px;">📦</span>
                    <div>
                        <p style="font-size: 11px; color: #8B7355;">Total Transaksi</p>
                        <p style="font-weight: bold; font-size: 20px; color: #D4A76A;">{{ $riwayat->count() }}</p>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <span style="font-size: 20px;">📞</span>
                    <div>
                        <p style="font-size: 11px; color: #8B7355;">No. HP</p>
                        <p style="font-size: 14px;">{{ $user->hp ?? 'Belum diisi' }}</p>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 20px;">📍</span>
                    <div>
                        <p style="font-size: 11px; color: #8B7355;">Alamat</p>
                        <p style="font-size: 14px;">{{ $user->alamat ?? 'Belum diisi' }}</p>
                    </div>
                </div>
            </div>
        </div>

 
        <div style="display: flex; flex-direction: column; gap: 28px;">

            <div style="background: white; border-radius: 20px; border: 1px solid #E8D5B5; overflow: hidden;">
                <div style="padding: 16px 20px; background: #FDF7F0; border-bottom: 1px solid #E8D5B5;">
                    <h2 style="font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #5C3D2E;">
                        ✏️ Edit Informasi Akun
                    </h2>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="padding: 24px;">
                    @csrf
                    @method('PUT')

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #5C3D2E; margin-bottom: 6px;">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap }}"
                                   style="width: 100%; padding: 10px 14px; border: 1px solid #E8D5B5; border-radius: 12px; background: #FFF9F5; font-family: inherit;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #5C3D2E; margin-bottom: 6px;">Email</label>
                            <input type="email" value="{{ $user->email }}" disabled
                                   style="width: 100%; padding: 10px 14px; border: 1px solid #E8D5B5; border-radius: 12px; background: #F0EDE8; color: #8B7355;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #5C3D2E; margin-bottom: 6px;">Username</label>
                            <input type="text" value="{{ $user->username }}" disabled
                                   style="width: 100%; padding: 10px 14px; border: 1px solid #E8D5B5; border-radius: 12px; background: #F0EDE8; color: #8B7355;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #5C3D2E; margin-bottom: 6px;">No. HP</label>
                            <input type="text" name="hp" value="{{ $user->hp }}"
                                   style="width: 100%; padding: 10px 14px; border: 1px solid #E8D5B5; border-radius: 12px; background: #FFF9F5;">
                        </div>
                        <div style="grid-column: span 2;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #5C3D2E; margin-bottom: 6px;">Alamat</label>
                            <textarea name="alamat" rows="2" style="width: 100%; padding: 10px 14px; border: 1px solid #E8D5B5; border-radius: 12px; background: #FFF9F5;">{{ $user->alamat }}</textarea>
                        </div>

                        {{-- UPLOAD FOTO PROFIL --}}
                        <div style="grid-column: span 2;">
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #5C3D2E; margin-bottom: 6px;">📷 Foto Profil</label>
                            @if($user->foto_profil)
                                <div style="margin-bottom: 10px;">
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}"
                                         style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid #D4A76A;">
                                    <p style="font-size: 11px; color: #8B7355; margin-top: 5px;">Foto saat ini</p>
                                </div>
                            @endif
                            <input type="file" name="foto_profil" accept="image/*"
                                   style="width: 100%; padding: 8px; border: 1px solid #E8D5B5; border-radius: 12px; background: #FFF9F5;">
                            <p style="font-size: 10px; color: #8B7355; margin-top: 4px;">Format: JPG, PNG, GIF. Max 2MB</p>
                        </div>
                    </div>

                    <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #E8D5B5;">
                        <p style="font-weight: 600; color: #5C3D2E; margin-bottom: 12px; font-size: 14px;">🔒 Ganti Password (opsional)</p>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div>
                                <label style="display: block; font-size: 12px; color: #8B7355; margin-bottom: 4px;">Password Baru</label>
                                <input type="password" name="password"
                                       style="width: 100%; padding: 10px 14px; border: 1px solid #E8D5B5; border-radius: 12px; background: #FFF9F5;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 12px; color: #8B7355; margin-bottom: 4px;">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                       style="width: 100%; padding: 10px 14px; border: 1px solid #E8D5B5; border-radius: 12px; background: #FFF9F5;">
                            </div>
                        </div>
                    </div>

                    <button type="submit" style="margin-top: 24px; background: #D4A76A; color: white; border: none; padding: 12px 28px; border-radius: 40px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                        💾 Simpan Perubahan
                    </button>
                </form>
            </div>

            <div style="background: white; border-radius: 20px; border: 1px solid #E8D5B5; overflow: hidden;">
                <div style="padding: 16px 20px; background: #FDF7F0; border-bottom: 1px solid #E8D5B5;">
                    <h2 style="font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #5C3D2E;">
                        📋 Riwayat Transaksi
                    </h2>
                </div>

                @forelse($riwayat as $t)
                <div style="padding: 16px 20px; border-bottom: 1px solid #E8D5B5;">
                    <div style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 12px;">
                        <div>
                            <p style="font-size: 11px; color: #8B7355; margin-bottom: 4px;">
                                {{ \Carbon\Carbon::parse($t->created_at)->format('d F Y, H:i') }}
                            </p>
                            <p style="font-weight: bold; font-size: 20px; color: #D4A76A;">
                                Rp {{ number_format($t->total_harga, 0, ',', '.') }}
                            </p>
                            <div style="display: flex; gap: 8px; margin-top: 8px;">
                                <span style="font-size: 11px; background: #F5EDE0; padding: 4px 12px; border-radius: 20px;">{{ $t->metode_bayar }}</span>
                                <span style="font-size: 11px; background: #F5EDE0; padding: 4px 12px; border-radius: 20px;">{{ $t->metode_kirim }}</span>
                            </div>
                        </div>
                        <a href="{{ route('transaksi.invoice', $t->id) }}" target="_blank"
                           style="border: 1px solid #D4A76A; color: #D4A76A; padding: 6px 16px; border-radius: 40px; font-size: 12px; text-decoration: none; transition: all 0.2s;">
                            🖨️ Cetak Invoice
                        </a>
                    </div>

                    <div style="margin-top: 12px; display: flex; flex-wrap: wrap; gap: 8px;">
                        @php $items = is_array($t->items) ? $t->items : json_decode($t->items, true); @endphp
                        @foreach($items as $item)
                            <span style="font-size: 11px; background: #FDF7F0; padding: 4px 12px; border-radius: 20px;">
                                {{ $item['nama_produk'] ?? $item['nama'] ?? 'Produk' }} × {{ $item['jumlah'] ?? 1 }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @empty
                <div style="padding: 48px 20px; text-align: center;">
                    <div style="font-size: 48px; margin-bottom: 12px;">🛒</div>
                    <p style="color: #8B7355;">Belum ada transaksi</p>
                    <a href="{{ route('landing') }}" style="display: inline-block; margin-top: 16px; background: #D4A76A; color: white; padding: 8px 24px; border-radius: 40px; text-decoration: none; font-size: 13px;">
                        Mulai Belanja
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            background: '#FFF9F5',
            color: '#4A3520',
            confirmButtonColor: '#D4A76A',
            timer: 3000,
            timerProgressBar: true
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            background: '#FFF9F5',
            color: '#4A3520',
            confirmButtonColor: '#D4A76A'
        });
    @endif

    @if(session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Informasi',
            text: '{{ session('info') }}',
            background: '#FFF9F5',
            color: '#4A3520',
            confirmButtonColor: '#D4A76A'
        });
    @endif
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form[action="{{ route('profile.update') }}"]');
        if (!form) return;

        const originalValues = {
            nama_lengkap: form.querySelector('[name="nama_lengkap"]')?.value || '',
            hp: form.querySelector('[name="hp"]')?.value || '',
            alamat: form.querySelector('[name="alamat"]')?.value || '',
            foto_profil: false,
            password: '',
            password_confirmation: ''
        };

        form.addEventListener('submit', function(e) {
            const currentValues = {
                nama_lengkap: form.querySelector('[name="nama_lengkap"]')?.value || '',
                hp: form.querySelector('[name="hp"]')?.value || '',
                alamat: form.querySelector('[name="alamat"]')?.value || '',
                foto_profil: form.querySelector('[name="foto_profil"]')?.files.length > 0,
                password: form.querySelector('[name="password"]')?.value || '',
                password_confirmation: form.querySelector('[name="password_confirmation"]')?.value || ''
            };

            const isNamaChanged = currentValues.nama_lengkap !== originalValues.nama_lengkap;
            const isHpChanged = currentValues.hp !== originalValues.hp;
            const isAlamatChanged = currentValues.alamat !== originalValues.alamat;
            const isFotoChanged = currentValues.foto_profil;
            const isPasswordChanged = currentValues.password !== '';

            if (!isNamaChanged && !isHpChanged && !isAlamatChanged && !isFotoChanged && !isPasswordChanged) {
                e.preventDefault();
                Swal.fire({
                    icon: 'info',
                    title: 'Tidak Ada Perubahan',
                    text: 'Silakan ubah data terlebih dahulu sebelum menyimpan.',
                    background: '#FFF9F5',
                    color: '#4A3520',
                    confirmButtonColor: '#D4A76A'
                });
                return false;
            }

            if (isPasswordChanged && currentValues.password !== currentValues.password_confirmation) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Password Tidak Cocok',
                    text: 'Password baru dan konfirmasi password harus sama.',
                    background: '#FFF9F5',
                    color: '#4A3520',
                    confirmButtonColor: '#D4A76A'
                });
                return false;
            }

            if (isPasswordChanged && currentValues.password.length < 6) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Password Terlalu Pendek',
                    text: 'Password minimal 6 karakter.',
                    background: '#FFF9F5',
                    color: '#4A3520',
                    confirmButtonColor: '#D4A76A'
                });
                return false;
            }
        });
    });
</script>
@endsection
