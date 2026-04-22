<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 0. Buat User Admin Default
        User::firstOrCreate(
            ['email' => 'admin@siakademik.ac.id'],
            [
                'name'     => 'Administrator',
                'password' => 'admin123', // Akan di-hash otomatis oleh cast 'hashed'
            ]
        );

        // 1. Generate Data Jurusan
        $jurusanIF = Jurusan::create([
            'nama_jurusan' => 'Teknik Informatika',
            'akreditasi' => 'A'
        ]);

        $jurusanSI = Jurusan::create([
            'nama_jurusan' => 'Sistem Informasi',
            'akreditasi' => 'B'
        ]);

        // 2. Generate Data Mahasiswa
        Mahasiswa::create([
            'nim' => '10123001',
            'nama' => 'Budi Santoso',
            'id_jurusan' => $jurusanIF->id_jurusan // Mengambil ID dari jurusan IF
        ]);

        Mahasiswa::create([
            'nim' => '10123002',
            'nama' => 'Siti Aminah',
            'id_jurusan' => $jurusanSI->id_jurusan // Mengambil ID dari jurusan SI
        ]);

        // 3. Generate Data Matakuliah
        Matakuliah::create([
            'nama_matakuliah' => 'Pemrograman Web 2',
            'sks' => 3,
            'id_jurusan' => $jurusanIF->id_jurusan
        ]);

        Matakuliah::create([
            'nama_matakuliah' => 'Basis Data',
            'sks' => 3,
            'id_jurusan' => $jurusanSI->id_jurusan
        ]);
    }
}
