<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $riwayat = Transaksi::where('user_id', $user->id)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('profile.index', compact('user', 'riwayat'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // max 2MB
            'password' => 'nullable|min:6|confirmed',
        ]);

        $changes = false;
        $updatedFields = [];

        // Cek perubahan nama_lengkap
        if ($request->nama_lengkap != $user->nama_lengkap) {
            $user->nama_lengkap = $request->nama_lengkap;
            $changes = true;
            $updatedFields[] = 'Nama lengkap';
        }

        // Cek perubahan hp
        if ($request->hp != $user->hp) {
            $user->hp = $request->hp;
            $changes = true;
            $updatedFields[] = 'No. HP';
        }

        // Cek perubahan alamat
        if ($request->alamat != $user->alamat) {
            $user->alamat = $request->alamat;
            $changes = true;
            $updatedFields[] = 'Alamat';
        }

        // Upload foto profil
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $user->foto_profil = $path;
            $changes = true;
            $updatedFields[] = 'Foto profil';
        }

        // Cek perubahan password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $changes = true;
            $updatedFields[] = 'Password';
        }

        // Jika tidak ada perubahan
        if (!$changes) {
            return redirect()->route('profile.index')
                             ->with('info', 'Tidak ada data yang diubah. Silakan ubah data terlebih dahulu.');
        }

        $user->save();

        $message = 'Profil berhasil diperbarui! (' . implode(', ', $updatedFields) . ')';

        return redirect()->route('profile.index')
                         ->with('success', $message);
    }
}
