<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string('rfid')->nullable();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('pekerjaan');
            $table->string('kewarganeragaan');
            $table->integer('is_active')->default(1);
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('wargas');
    }
}
