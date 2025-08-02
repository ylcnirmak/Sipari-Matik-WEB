<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staff_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('cashier_id');
            $table->unsignedBigInteger('permission_id');
            $table->timestamps();
            
            $table->unique(['cashier_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_permissions');
    }
};
