<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TpqSetting;

class TpqSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaults = [
            'tpq_name' => 'TPQ Al Muhajirin Harmoni',
            'tpq_description' => 'Pusat pendidikan Al-Qur\'an untuk penguatan karakter dan hafalan.',
            'tpq_address' => 'Jl. Contoh No.123, Kota',
            'tpq_phone' => '+62 812-3456-7890',
            'tpq_email' => 'info@tpq-harmoni.example',
        ];

        foreach ($defaults as $k => $v) {
            TpqSetting::updateOrCreate(['key' => $k], ['value' => $v]);
        }
    }
}
