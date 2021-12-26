<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('slug'); // agar url terdapat tulisan keterangannya dari topik yang dibuka
            $table->string('lokasi');
            $table->longText('isi');
            $table->string('event_penting');
            $table->string('bahasa');
            $table->string('makanan');
            $table->date('tgl_berangkat');
            $table->string('durasi');
            $table->string('jenis');
            $table->integer('harga');
            $table->softDeletes(); // Untuk mencadangkan data yang terdelete ( delete sementara )
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
        Schema::dropIfExists('travel_packages');
    }
}
