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
            $table->json('matriks_x');
            $table->double('max_x');
            $table->json('normalisasi_matriks_r'); //Normalisasi matrix R
            $table->json('normalisasi_matriks_y'); //Normalisasi matrix Y (pembobotan)
            $table->double('solusi_ideal_positif'); //Solusi ideal positif (A+)
            $table->double('solusi_ideal_negatif'); //Solusi ideal negatif (A-)
            $table->double('jarak_terbobot_a_positif'); //Jarak Terbobot(D+) antara nilai tiap alternatif dgn Solusi ideal positif (A+)
            $table->double('jarak_terbobot_a_negatif'); //Jarak Terbobot(D-) antara nilai tiap alternatif dgn Solusi ideal negatif (A-)
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
