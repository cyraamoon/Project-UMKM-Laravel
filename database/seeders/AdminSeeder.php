<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
    'nama_lengkap' => 'Administrator',
    'email'        => 'admin@gmail.com',
    'username'     => 'admin',
    'password'     => Hash::make('admin123'),
    'role'         => 'admin',
]);
    }
}
