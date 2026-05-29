<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    // Tampilkan form testimonial
    public function create()
    {
        return view('testimonial.form');
    }

    // Simpan testimonial (tanpa batasan 1 user 1 testimonial)
    public function store(Request $request)
    {
        $request->validate([
            'testimoni' => 'required|string|min:10|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create([
            'user_id' => Auth::id(),
            'testimoni' => $request->testimoni,
            'rating' => $request->rating,
            'status' => 'pending', // Butuh approval admin
        ]);

        return redirect()->route('landing')->with('success', 'Terima kasih! Testimonial Anda akan ditampilkan setelah disetujui admin.');
    }

    // ==================== ADMIN ====================

    // Admin: lihat semua testimonial
    public function adminIndex()
    {
        $testimonials = Testimonial::with('user')->latest()->paginate(10);
        return view('admin.testimonials', compact('testimonials'));
    }

    // Admin: approve testimonial
    public function approve($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Testimonial disetujui!');
    }

    // Admin: reject testimonial
    public function reject($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Testimonial ditolak!');
    }

    // Admin: hapus testimonial
    public function destroy($id)
    {
        Testimonial::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Testimonial dihapus!');
    }
}
