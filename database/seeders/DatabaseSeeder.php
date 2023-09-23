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
            'name' => 'Admin',
            'nip' => '00000000',
            'email' => null,
            'password' => bcrypt('admin123'),
            'jabatan' => 'Super Admin',
            'level' => 'Admin',
            'phone' => '085465258965'
        ]);

        User::create([
            'name' => 'Pegawai A',
            'nip' => '12345678',
            'email' => null,
            'password' => bcrypt('password'),
            'jabatan' => 'Pegawai A',
            'level' => 'Keuangan',
            'phone' => '08546525896122'
        ]);

        User::create([
            'name' => 'Pegawai B',
            'nip' => '123456789',
            'email' => null,
            'password' => bcrypt('password'),
            'jabatan' => 'Pegawai B',
            'level' => 'User',
            'phone' => '085465258961'
        ]);
        
        User::create([
            'name' => 'Pegawai C',
            'nip' => '1234567890',
            'email' => null,
            'password' => bcrypt('password'),
            'jabatan' => 'Pegawai C',
            'level' => 'User',
            'phone' => '081312341234'
        ]);

        // User::create([
        //     'name' => 'User Test',
        //     'nip' => '12345678',
        //     'email' => null,
        //     'password' => bcrypt('12345678'),
        //     'jabatan' => 'Testing',
        //     'level' => 'User',
        //     'phone' => '085465258962'
        // ]);
    
        // User::create([
        //     'name' => 'User Test 2',
        //     'nip' => '123456781',
        //     'email' => null,
        //     'password' => bcrypt('123456781'),
        //     'jabatan' => 'Testing 2',
        //     'level' => 'User',
        //     'phone' => '0854652589621'
        // ]);

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
