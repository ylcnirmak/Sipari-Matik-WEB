<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('urunler', function (Blueprint $table) {
            $table->id();
            $table->integer('restaurant_id');
            $table->integer('kategori_id');
            $table->string('urunadi');
            $table->text('aciklama')->nullable();
            $table->decimal('fiyat', 8, 2);
            $table->string('resim')->nullable();
            $table->integer('hazirlanma_suresi')->nullable(); // dakika
            $table->boolean('stokta_var')->default(1);
            $table->boolean('aktif')->default(1);
            $table->integer('sira')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('urunler');
    }
};