<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kriteria;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        Siswa::factory(10)->create();
        // Siswa::create([
        //     'nama' => 'Basit',
        //     'jk' => 'L',
        //     'ttl' => '16 Juni 1998',
        //     'alamat' => 'jl.abc, tangerang'
        // // ],
        // // [
        // //     'nama' => 'Abdul',
        // //     'jk' => 'L',
        // //     'ttl' => '06 Juli 1998',
        // //     'alamat' => 'jl.abc, jakarta'
        // // ],
        // // [
        // //     'nama' => 'Bunga',
        // //     'jk' => 'P',
        // //     'ttl' => '16 Agustus 1998',
        // //     'alamat' => 'jl.abc, bekasi'
        // ]);

        Kriteria::create([
            'kode' => 'C1',
            'nama' => 'Bacaan Quran',
            'pembobotan_kriteria' => [
                [
                    'pilihan' => '90-100',
                    'bobot' => '4' 
                ],
                [
                    'pilihan' => '80-89',
                    'bobot' => '3' 
                ],
                [
                    'pilihan' => '65-79',
                    'bobot' => '2' 
                ],
                [
                    'pilihan' => '0-64',
                    'bobot' => '1' 
                ],
            ]
        ]);
        Kriteria::create([
            'kode' => 'C2',
            'nama' => 'Hafalan Quran',
            'pembobotan_kriteria' => [
                [
                    'pilihan' => '90-100',
                    'bobot' => '4' 
                ],
                [
                    'pilihan' => '80-89',
                    'bobot' => '3' 
                ],
                [
                    'pilihan' => '65-79',
                    'bobot' => '2' 
                ],
                [
                    'pilihan' => '0-64',
                    'bobot' => '1' 
                ],
            ]
        ]);
        Kriteria::create([
            'kode' => 'C3',
            'nama' => 'Bacaan Shalat',
            'pembobotan_kriteria' => [
                [
                    'pilihan' => '90-100',
                    'bobot' => '4' 
                ],
                [
                    'pilihan' => '80-89',
                    'bobot' => '3' 
                ],
                [
                    'pilihan' => '65-79',
                    'bobot' => '2' 
                ],
                [
                    'pilihan' => '0-64',
                    'bobot' => '1' 
                ],
            ]
        ]);
        Kriteria::create([
            'kode' => 'C4',
            'nama' => 'Tes Kepribadian',
            'pembobotan_kriteria' => [
                [
                    'pilihan' => '90-100',
                    'bobot' => '4' 
                ],
                [
                    'pilihan' => '80-89',
                    'bobot' => '3' 
                ],
                [
                    'pilihan' => '65-79',
                    'bobot' => '2' 
                ],
                [
                    'pilihan' => '0-64',
                    'bobot' => '1' 
                ],
            ]
        ]);
        Kriteria::create([
            'kode' => 'C5',
            'nama' => 'Penghasilan Orang Tua',
            'pembobotan_kriteria' => [
                [
                    'pilihan' => '< 1 JT',
                    'bobot' => '4' 
                ],
                [
                    'pilihan' => '1 JT - < 4.2 JT',
                    'bobot' => '3' 
                ],
                [
                    'pilihan' => '4.2 JT - 10 JT',
                    'bobot' => '2' 
                ],
                [
                    'pilihan' => '> 10 JT',
                    'bobot' => '1' 
                ],
            ]
        ]);
        Kriteria::create([
            'kode' => 'C6',
            'nama' => 'Status',
            'pembobotan_kriteria' => [
                [
                    'pilihan' => 'Yatim & Piatu',
                    'bobot' => '4' 
                ],
                [
                    'pilihan' => 'Yatim',
                    'bobot' => '3' 
                ],
                [
                    'pilihan' => 'Piatu',
                    'bobot' => '2' 
                ],
                [
                    'pilihan' => 'Orang Tua Lengkap',
                    'bobot' => '1' 
                ],
            ]
        ]);
    }
}
