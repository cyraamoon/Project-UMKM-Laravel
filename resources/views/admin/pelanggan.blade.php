@extends('layouts.admin')
@section('page-title', 'Data Pelanggan')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">👥 Data Pelanggan</h2>
    </div>
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Bergabung Sejak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggan as $user)
                <tr>
                    <td>#{{ $user->id }}</td>
                    <td style="font-weight: 500;">{{ $user->nama_lengkap ?? '-' }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->hp ?? '-' }}</td>
                    <td>{{ Str::limit($user->alamat ?? '-', 30) }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('admin.pelanggan.reset', $user->id) }}" method="POST"
                              onsubmit="return confirm('Reset password untuk {{ $user->username }}?\n\nPassword baru: 12345678')">
                            @csrf
                            <button type="submit" class="btn-outline" style="background: none; border: 1px solid #D4A76A; padding: 6px 12px; border-radius: 8px; cursor: pointer;">
                                <i class="ti ti-key"></i> Reset Password
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 60px; color: #B8956E;">
                        <i class="ti ti-users-off" style="font-size: 48px;"></i>
                        <p style="margin-top: 12px;">Belum ada pelanggan yang terdaftar.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding: 12px 24px; border-top: 1px solid #E8D5B5;">
        {{ $pelanggan->links() }}
    </div>
</div>

<style>
    .btn-outline {
        background: transparent;
        border: 1px solid #D4A76A;
        color: #5C3D2E;
        padding: 6px 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-outline:hover {
        background: #D4A76A;
        color: white;
    }
</style>
@endsection
