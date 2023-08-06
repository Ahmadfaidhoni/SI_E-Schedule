<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Config;
use App\Models\Ruangan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin 1',
            'nip' => '00000000',
            'email' => null,
            'password' => bcrypt('admin123'),
            'jabatan' => 'Super Admin',
            'level' => 'Admin',
            'phone' => '085465258965'
        ]);

        User::create([
            'name' => 'Admin 2',
            'nip' => '99999999',
            'email' => null,
            'password' => bcrypt('admin123'),
            'jabatan' => 'Super Admin 2',
            'level' => 'Admin',
            'phone' => '085465258961'
        ]);

        User::create([
            'name' => 'Keuangan Test',
            'nip' => '1234567812',
            'email' => null,
            'password' => bcrypt('1234567812'),
            'jabatan' => 'Testing',
            'level' => 'Keuangan',
            'phone' => '085465258961'
        ]);
        
        User::create([
            'name' => 'Keuangan Test 2',
            'nip' => '12345678121',
            'email' => null,
            'password' => bcrypt('12345678121'),
            'jabatan' => 'Testing 2',
            'level' => 'Keuangan',
            'phone' => '0854652589611'
        ]);

        User::create([
            'name' => 'User Test',
            'nip' => '12345678',
            'email' => null,
            'password' => bcrypt('12345678'),
            'jabatan' => 'Testing',
            'level' => 'User',
            'phone' => '085465258962'
        ]);
    
        User::create([
            'name' => 'User Test 2',
            'nip' => '123456781',
            'email' => null,
            'password' => bcrypt('123456781'),
            'jabatan' => 'Testing 2',
            'level' => 'User',
            'phone' => '0854652589621'
        ]);

        Kegiatan::create([
            'kode_kegiatan' => 'PKP',
            'nama_kegiatan' => 'Pelatihan Kepemimpinan'
        ]);

        Kegiatan::create([
            'kode_kegiatan' => 'PKA',
            'nama_kegiatan' => 'Pelatihan Keanggotaan'
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang 1',
            'kapasitas' => '50',
            'gedung' => 'Gunung Kidul',
            'lantai' => '2'
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang 2',
            'kapasitas' => '50',
            'gedung' => 'Gunung Kidul',
            'lantai' => '2'
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang 3',
            'kapasitas' => '50',
            'gedung' => 'Gunung Kidul',
            'lantai' => '2'
        ]);

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
