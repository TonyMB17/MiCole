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
        Schema::create('modal_settings', function (Blueprint $table) {
            $table->id();
            $table->string('content'); // Contenido del modal
            $table->boolean('is_active')->default(true); // Si el modal está activo
            $table->timestamp('start_date'); // Fecha de inicio
            $table->timestamp('end_date'); // Fecha de finalización
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modal_settings');
    }
};
