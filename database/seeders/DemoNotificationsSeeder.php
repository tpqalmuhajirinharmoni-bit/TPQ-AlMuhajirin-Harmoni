<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Notification;

class DemoNotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure admin role exists
        $adminRole = Role::firstOrCreate([
            'slug' => 'admin'
        ], [
            'name' => 'Admin',
            'description' => 'Administrator sistem'
        ]);

        // Ensure admin user exists
        $admin = User::firstOrCreate([
            'email' => 'admin@tpqharmoni.local'
        ], [
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => Hash::make('password123'),
        ]);

        // Attach role
        $admin->roles()->syncWithoutDetaching([$adminRole->id]);

        // Create demo notifications for admin
        Notification::createForUser($admin, 'new_user', 'Pengguna Baru Terdaftar', 'Pengguna baru dengan email guru@example.com telah mendaftar.', ['email' => 'guru@example.com']);
        Notification::createForUser($admin, 'new_message', 'Pesan Masuk', 'Ada pesan kontak baru dari pengunjung.', ['from' => 'pengunjung@example.com']);
        Notification::createForUser($admin, 'profile_update', 'Profil Diperbarui', 'Seorang pengguna memperbarui profilnya.', []);
        Notification::createForUser($admin, 'password_change', 'Perubahan Kata Sandi', 'Seorang pengguna mengganti kata sandi.', []);
    }
}
