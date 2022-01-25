<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSawTopsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saw_topses', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->json('normalisasi_matriks_r'); //Normalisasi matrix R
            $table->json('normalisasi_matriks_y'); //Normalisasi matrix Y (pembobotan)
            $table->double('nilai_preferensi'); //Nilai preferensi tiap alternatif
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
        Schema::dropIfExists('saw_topses');
    }
}
