<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masalar', function (Blueprint $table) {
            $table->id();
            $table->integer('restaurant_id');
            $table->foreignId('masakategori_id')->constrained('masalarkategori');
            $table->string('masaadi', 255);
            $table->integer('kisi_sayisi')->default(0);
            $table->integer('garson_id')->nullable();
            $table->integer('sira')->nullable();
            $table->integer('adisyonyaz')->nullable();
            $table->integer('adisyon_id')->nullable();
            $table->integer('rezervasyon_id')->nullable();
            $table->string('sure', 255);
            $table->boolean('aktif')->default(true);
            $table->float('toplam_tutar')->default(0);
            $table->float('indirim')->default(0);
            $table->float('geneltoplam')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masalar');
    }
};