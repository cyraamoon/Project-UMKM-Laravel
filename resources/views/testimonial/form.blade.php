@extends('layouts.app')

@section('title', 'Berikan Testimonial')

@section('content')
<div style="max-width: 600px; margin: 50px auto; padding: 20px;">
    <div style="background: white; border-radius: 20px; border: 1px solid #E8D5B5; padding: 30px;">
        <h1 style="font-family: 'Playfair Display'; color: #5C3D2E; margin-bottom: 10px;">✨ Bagikan Pengalaman Anda</h1>
        <p style="color: #8B7355; margin-bottom: 25px;">Pendapat Anda sangat berharga bagi kami!</p>

        <form action="{{ route('testimonial.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Rating Anda</label>
                <div class="rating-input" style="display: flex; gap: 8px; font-size: 30px; cursor: pointer;">
                    <span data-rating="1">☆</span>
                    <span data-rating="2">☆</span>
                    <span data-rating="3">☆</span>
                    <span data-rating="4">☆</span>
                    <span data-rating="5">☆</span>
                </div>
                <input type="hidden" name="rating" id="rating" value="5" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Testimonial</label>
                <textarea name="testimoni" rows="5" placeholder="Ceritakan pengalaman Anda berbelanja di La Brioche..." required style="width: 100%; padding: 12px; border: 1px solid #E8D5B5; border-radius: 12px;"></textarea>
                <small style="color: #8B7355;">Minimal 10 karakter, maksimal 500 karakter.</small>
            </div>

            <button type="submit" style="width: 100%; padding: 12px; background: #D4A76A; color: white; border: none; border-radius: 40px; font-weight: bold; cursor: pointer;">
                Kirim Testimonial
            </button>
        </form>

        <div style="margin-top: 20px; text-align: center;">
            <a href="{{ route('landing') }}" style="color: #8B7355;">← Kembali</a>
        </div>
    </div>
</div>

<script>
    const stars = document.querySelectorAll('.rating-input span');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating;
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.innerHTML = '★';
                    s.style.color = '#D4A76A';
                } else {
                    s.innerHTML = '☆';
                    s.style.color = '#E8D5B5';
                }
            });
        });
    });
</script>
@endsection
