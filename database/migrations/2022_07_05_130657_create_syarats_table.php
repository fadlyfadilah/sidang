<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syarats', function (Blueprint $table) {
            $table->id();
            $table->string('skripsi');
            $table->enum('skripsistatus', ['0','1','2'])->default('0');
            $table->string('photo');
            $table->enum('photostatus', ['0','1','2'])->default('0');
            $table->string('serticalonsarjana');
            $table->enum('serticalonsarjanastatus', ['0','1','2'])->default('0');
            $table->string('sertibebasperpus');
            $table->enum('sertibebasperpusstatus', ['0','1','2'])->default('0');
            $table->string('sertimaba');
            $table->enum('sertimabastatus', ['0','1','2'])->default('0');
            $table->string('bebaslab')->nullable();
            $table->enum('bebaslabstatus', ['0','1','2'])->default('0');
            $table->string('transkrip');
            $table->enum('transkripstatus', ['0','1','2'])->default('0');
            $table->string('pembayaran');
            $table->enum('pembayaranstatus', ['0','1','2'])->default('0');
            $table->string('status')->default('Belum Terverifikasi');
            $table->string('feedback')->nullable();
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
        Schema::dropIfExists('syarats');
    }
};
