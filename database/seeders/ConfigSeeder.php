<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::create([
            'key' => 'BIAYA_JP',
            'value' => '45000',
            'group' => 'KEUANGAN',
        ]);

        Config::create([
            'key' => 'MAX_JP',
            'value' => '15',
            'group' => 'JADWAL',
        ]);
    }
}
