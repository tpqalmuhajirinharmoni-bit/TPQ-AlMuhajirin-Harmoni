<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $roles = [
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Administrator sistem'],
            ['name' => 'Pembina', 'slug' => 'pembina', 'description' => 'Pembina TPQ'],
            ['name' => 'Penanggung Jawab', 'slug' => 'penanggung-jawab', 'description' => 'Penanggung Jawab TPQ'],
            ['name' => 'Ketua', 'slug' => 'ketua', 'description' => 'Ketua Organisasi'],
            ['name' => 'Sekretaris', 'slug' => 'sekretaris', 'description' => 'Sekretaris Organisasi'],
            ['name' => 'Bendahara', 'slug' => 'bendahara', 'description' => 'Bendahara TPQ'],
            ['name' => 'Guru', 'slug' => 'guru', 'description' => 'Guru TPQ'],
            ['name' => 'Wali Santri', 'slug' => 'wali-santri', 'description' => 'Wali/Orang Tua Santri'],
            ['name' => 'Santri', 'slug' => 'santri', 'description' => 'Siswa TPQ'],
            ['name' => 'Tamu', 'slug' => 'tamu', 'description' => 'Pengunjung/Tamu'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['slug' => $role['slug']], $role);
        }

        // Create demo users
        $adminUser = User::updateOrCreate([
            'email' => 'admin@tpqharmoni.local'
        ], [
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => Hash::make('password123'),
        ]);
        $adminUser->roles()->syncWithoutDetaching([Role::where('slug', 'admin')->first()->id]);

        $guruUser = User::updateOrCreate([
            'email' => 'nurul@tpqharmoni.local'
        ], [
            'username' => 'nurul',
            'name' => 'Nurul Huda',
            'password' => Hash::make('password123'),
        ]);
        $guruUser->roles()->syncWithoutDetaching([Role::where('slug', 'guru')->first()->id]);

        $santriUser = User::updateOrCreate([
            'email' => 'aisyah@tpqharmoni.local'
        ], [
            'username' => 'aisyah',
            'name' => 'Aisyah Zahra',
            'password' => Hash::make('password123'),
        ]);
        $santriUser->roles()->syncWithoutDetaching([Role::where('slug', 'santri')->first()->id]);

        $waliUser = User::updateOrCreate([
            'email' => 'orangtua@tpqharmoni.local'
        ], [
            'username' => 'ibubapak',
            'name' => 'Ibu Bapak Aisyah',
            'password' => Hash::make('password123'),
        ]);
        $waliUser->roles()->syncWithoutDetaching([Role::where('slug', 'wali-santri')->first()->id]);

        // Seed default TPQ settings
        $this->call([\Database\Seeders\TpqSettingsSeeder::class]);
    }
}
