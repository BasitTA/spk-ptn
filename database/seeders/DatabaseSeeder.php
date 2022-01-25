<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\NilaiSiswa;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        // Siswa::factory(5)->create();

        //USER
        User::create([
            'name' => 'basit',
            'username' => 'basit_eng',
            'email' => 'bta.aang@gmail.com',
            //pass: 12345
            'password' => '$2y$10$Wxxqb0NQZnpNW.o/IlHcKOETgypKMR2Nl5AbKedPhYi1qNgbkP/2S',
        ]);

        //SISWA
        Siswa::create([
            'nilai_siswa_id' => 1,
            'nama' => 'Andri',
            'jk' => 'L',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '12-06-2006',
            'alamat' => 'Jl. Taruna Putri No. 7, Bogor, Jawa Barat'
        ]);
        
        Siswa::create([
            'nilai_siswa_id' => 2,
            'nama' => 'Sopyan',
            'jk' => 'L',
            'tempat_lahir' => 'Tangerang',
            'tanggal_lahir' => '04-06-2004',
            'alamat' => 'Jl. Parangtritis No. 53, Tangerang, Banten'
        ]);

        Siswa::create([
            'nilai_siswa_id' => 3,
            'nama' => 'Taufiq',
            'jk' => 'L',
            'tempat_lahir' => 'Tasikmalaya',
            'tanggal_lahir' => '10-11-2004',
            'alamat' => 'Jl. Tretes Raya No. 23, Tangerang, Banten'
        ]);

        Siswa::create([
            'nilai_siswa_id' => 4,
            'nama' => 'Ramadhan',
            'jk' => 'L',
            'tempat_lahir' => 'Bogor',
            'tanggal_lahir' => '10-11-2008',
            'alamat' => 'Jl. Purwanasari No. 5, Bogor, Jawa Barat'
        ]);

        Siswa::create([
            'nilai_siswa_id' => 5,
            'nama' => 'Ibrahim',
            'jk' => 'L',
            'tempat_lahir' => 'Sumedang',
            'tanggal_lahir' => '02-04-2003',
            'alamat' => 'Jl. Medan Raya No. 8, Tangerang, Banten'
        ]);

        //NILAI SISWA
        NilaiSiswa::create([
            'id' => 1,
            'nama' => 'Andri',
            'pilihan' => [
                2,
                2,
                3,
                2,
                4,
                4
            ],
        ]);

        NilaiSiswa::create([
            'id' => 2,
            'nama' => 'Sopyan',
            'pilihan' => [
                3,
                3,
                3,
                3,
                2,
                3
            ],
        ]);

        NilaiSiswa::create([
            'id' => 3,
            'nama' => 'Taufiq',
            'pilihan' => [
                4,
                3,
                4,
                3,
                3,
                1
            ],
        ]);

        NilaiSiswa::create([
            'id' => 4,
            'nama' => 'Ramadhan',
            'pilihan' => [
                2,
                1,
                3,
                2,
                2,
                2
            ],
        ]);

        NilaiSiswa::create([
            'id' => 5,
            'nama' => 'Ibrahim',
            'pilihan' => [
                3,
                2,
                4,
                3,
                1,
                1
            ],
        ]);

        //KRITERIA
        Kriteria::create([
            'kode' => 'C1',
            'nama' => 'Bacaan Quran',
            'jenis' => 'Benefit',
            'bobot_kriteria' => 0.25,
            'pembobotan_kriteria' => [
                [
                    'pilihan' => '90-100',
                    'bobot' => 4 
                ],
                [
                    'pilihan' => '80-89',
                    'bobot' => 3 
                ],
                [
                    'pilihan' => '65-79',
                    'bobot' => 2
                ],
                [
                    'pilihan' => '0-64',
                    'bobot' => 1 
                ],
            ]
        ]);
        
        Kriteria::create([
            'kode' => 'C2',
            'nama' => 'Hafalan Quran',
            'jenis' => 'Benefit',
            'bobot_kriteria' => 0.25,
            'pembobotan_kriteria' => [
                [
                    'pilihan' => '90-100',
                    'bobot' => 4 
                ],
                [
                    'pilihan' => '80-89',
                    'bobot' => 3 
                ],
                [
                    'pilihan' => '65-79',
                    'bobot' => 2 
                ],
                [
                    'pilihan' => '0-64',
                    'bobot' => 1 
                ],
            ]
        ]);

        Kriteria::create([
            'kode' => 'C3',
            'nama' => 'Bacaan Shalat',
            'jenis' => 'Benefit',
            'bobot_kriteria' => 0.20,
            'pembobotan_kriteria' => [
                [
                    'pilihan' => '90-100',
                    'bobot' => 4 
                ],
                [
                    'pilihan' => '80-89',
                    'bobot' => 3 
                ],
                [
                    'pilihan' => '65-79',
                    'bobot' => 2 
                ],
                [
                    'pilihan' => '0-64',
                    'bobot' => 1 
                ],
            ]
        ]);

        Kriteria::create([
            'kode' => 'C4',
            'nama' => 'Tes Kepribadian',
            'jenis' => 'Benefit',
            'bobot_kriteria' => 0.15,
            'pembobotan_kriteria' => [
                [
                    'pilihan' => '90-100',
                    'bobot' => 4 
                ],
                [
                    'pilihan' => '80-89',
                    'bobot' => 3 
                ],
                [
                    'pilihan' => '65-79',
                    'bobot' => 2 
                ],
                [
                    'pilihan' => '0-64',
                    'bobot' => 1 
                ],
            ]
        ]);

        Kriteria::create([
            'kode' => 'C5',
            'nama' => 'Penghasilan Orang Tua',
            'jenis' => 'Cost',
            'bobot_kriteria' => 0.10,
            'pembobotan_kriteria' => [
                [
                    'pilihan' => '> 10 JT',
                    'bobot' => 4 
                ],
                [
                    'pilihan' => '4.2 JT - 10 JT',
                    'bobot' => 3 
                ],
                [
                    'pilihan' => '1 JT - < 4.2 JT',
                    'bobot' => 2 
                ],
                [
                    'pilihan' => '< 1 JT',
                    'bobot' => 1 
                ],
            ]
        ]);

        Kriteria::create([
            'kode' => 'C6',
            'nama' => 'Status',
            'jenis' => 'Benefit',
            'bobot_kriteria' => 0.05,
            'pembobotan_kriteria' => [
                [
                    'pilihan' => 'Yatim & Piatu',
                    'bobot' => 4 
                ],
                [
                    'pilihan' => 'Yatim',
                    'bobot' => 3 
                ],
                [
                    'pilihan' => 'Piatu',
                    'bobot' => 2 
                ],
                [
                    'pilihan' => 'Orang Tua Lengkap',
                    'bobot' => 1 
                ],
            ]
        ]);
    }
}
