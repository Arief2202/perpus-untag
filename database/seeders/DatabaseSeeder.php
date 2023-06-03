<?php

namespace Database\Seeders;

use File;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Buku;
use App\Models\Keanggotaan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::insert([
            'name' => 'Admin 1',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make("password"),
            'keanggotaan_id' => 2,
        ]);
        User::insert([
            'name' => 'Super Admin 1',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make("password"),
            'keanggotaan_id' => 1,
        ]);
        User::insert([
            'name' => 'Guest',
            'username' => 'guest',
            'email' => 'guest@gmail.com',
            'password' => Hash::make("password"),
            'keanggotaan_id' => 3,
        ]);
        User::insert([
            'name' => 'Arief',
            'username' => 'arief',
            'email' => 'arief.d2202@gmail.com',
            'password' => Hash::make("password"),
            'keanggotaan_id' => 2,
        ]);
        for($a=1; $a<=10; $a++){            
            User::insert([
                'name' => 'User '.$a,
                'username' => '31205000'.($a<10?'0':'').$a,
                'email' => 'user'.$a.'@gmail.com',
                'password' => Hash::make("password"),
                'keanggotaan_id' => 4,
            ]);
        }
        Buku::insert([
            'judul' => 'Pemrograman Basis Data Menggunakan MySQL',
            'deskripsi' => 'Penulisan buku Pemrograman Basis Data Menggunakan MySQL ini adalah dalam rangka melengkapi perangkat pembelajaran mata kuliah Basis Data Lanjut pada program studi Teknik Informatika, Politeknik Negeri Banjarmasin.',
            'pengarang' => 'Rahimi Fitri, S.Kom., M.Kom',
            'impresium' => 'Jakarta Deepublish Oktober 2020',
            'kolasi' => 'viii, 129 p ; 17.5×25 cm',
            'isbn_issn' => 123456789101112,
            'no_inventaris' => '001.42/Rah/P',
            'prefix' => 'B',
            'length_code' => '3',
            'jumlah' => '10',
            'bahasa' => 'indonesia',
            'prodi' => 'Teknik Informatika',
            'lokasi' => '001-002 A'
        ]);
        
        Keanggotaan::insert([
            'nama_keanggotaan' => 'Super Admin',
            'max_pinjam' => 0,
            'masa_aktif_pinjam' => 0,
            'denda_per_hari' => 0
        ]);
        Keanggotaan::insert([
            'nama_keanggotaan' => 'Admin',
            'max_pinjam' => 0,
            'masa_aktif_pinjam' => 0,
            'denda_per_hari' => 0
        ]);
        Keanggotaan::insert([
            'nama_keanggotaan' => 'Dosen',
            'max_pinjam' => 10,
            'masa_aktif_pinjam' => 10,
            'denda_per_hari' => 5000
        ]);
        Keanggotaan::insert([
            'nama_keanggotaan' => 'Mahasiswa',
            'max_pinjam' => 5,
            'masa_aktif_pinjam' => 5,
            'denda_per_hari' => 10000
        ]);
        File::delete(public_path('uploads/img/profile/*'));
    }
}
