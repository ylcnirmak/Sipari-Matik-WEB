<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('urunlerkategori', function (Blueprint $table) {
            $table->id();
            $table->integer('restaurant_id');
            $table->string('kategori_adi');
            $table->string('aciklama')->nullable();
            $table->decimal('KDV', 8, 2);
            $table->string('resim')->nullable();
            $table->integer('sira')->default(0); 
            $table->boolean('aktif')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('urunlerkategori');
    }
};