<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ], [
            'email.required'    => 'Email atau username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Coba login dengan email
        $credentials = ['email' => $request->email, 'password' => $request->password];

        // Jika bukan format email, coba login dengan username
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('username', $request->email)->first();
            if ($user) {
                $credentials = ['email' => $user->email, 'password' => $request->password];
            }
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Selamat datang kembali, Admin!');
            }

            return redirect()->route('landing')
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->nama_lengkap . '!');
        }

        return back()
            ->withErrors(['email' => 'Email/username atau password salah.'])
            ->withInput();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|email|unique:users',
            'username'     => 'required|string|unique:users',
            'password'     => 'required|min:6|confirmed',
            'phone'        => 'nullable|string|max:20',
            'alamat'       => 'nullable|string|max:500',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email sudah terdaftar.',
            'username.required'     => 'Username wajib diisi.',
            'username.unique'       => 'Username sudah digunakan.',
            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'username'     => $request->username,
            'password'     => Hash::make($request->password),
            'hp'           => $request->phone,
            'alamat'       => $request->alamat,
            'role'         => 'pelanggan',
        ]);

        Auth::login($user);

        return redirect()->route('landing')
            ->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->nama_lengkap . ' 🎉');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('status', 'Kamu telah berhasil keluar.');
    }
}
