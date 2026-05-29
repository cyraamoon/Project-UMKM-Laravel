@extends('layouts.admin')
@section('page-title', 'Kelola Testimonial')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">⭐ Kelola Testimonial Pelanggan</h2>
    </div>
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Testimonial</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->user->nama_lengkap ?? $t->user->username }}</td>
                    <td>{{ Str::limit($t->testimoni, 50) }}</td>
                    <td style="color: #D4A76A;">{{ $t->rating }}★</td>
                    <td>
                        @if($t->status == 'pending')
                            <span style="background: #FFD700; padding: 4px 10px; border-radius: 20px;">Pending</span>
                        @elseif($t->status == 'approved')
                            <span style="background: #4CAF50; color: white; padding: 4px 10px; border-radius: 20px;">Approved</span>
                        @else
                            <span style="background: #f44336; color: white; padding: 4px 10px; border-radius: 20px;">Rejected</span>
                        @endif
                    </td>
                    <td>{{ $t->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            @if($t->status == 'pending')
                                <form action="{{ route('admin.testimonial.approve', $t->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background: #4CAF50; color: white; border: none; padding: 5px 10px; border-radius: 5px;">✓ Approve</button>
                                </form>
                                <form action="{{ route('admin.testimonial.reject', $t->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background: #ff9800; color: white; border: none; padding: 5px 10px; border-radius: 5px;">✗ Reject</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.testimonial.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus testimonial ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background: #f44336; color: white; border: none; padding: 5px 10px; border-radius: 5px;">🗑️ Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align: center;">Belum ada testimonial.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $testimonials->links() }}
</div>
@endsection
