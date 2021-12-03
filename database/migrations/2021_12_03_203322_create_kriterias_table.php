<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // "kode" => "C6",
        //     "nama" => "Status",
        //     "pembobotan_kriteria" => [
        //         [
        //             "pilihan" => "Yatim & Piatu",
        //             "bobot" => "4" 
        //         ],
        //         [
        //             "pilihan" => "Yatim",
        //             "bobot" => "3" 
        //         ],
        //         [
        //             "pilihan" => "Piatu",
        //             "bobot" => "2" 
        //         ],
        //         [
        //             "pilihan" => "Orang Tua Lengkap",
        //             "bobot" => "1" 
        //         ],
            // ],
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->json('pembobotan_kriteria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kriterias');
    }
}
