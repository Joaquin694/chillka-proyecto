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
        Schema::create('ciudades', function (Blueprint $table) {
            $table->id('id_ciudad');
            $table->foreignId('departamento_id')->constrained('departamentos', 'id_departamento')->onDelete('cascade');
            $table->string('nombre_ciudad', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // En la migración de 'departamentos' o 'ciudades'
Schema::dropIfExists('hogares');  // Eliminar la tabla dependiente primero
Schema::dropIfExists('ciudades');  // Luego eliminar 'ciudades'
Schema::dropIfExists('departamentos');   // Luego eliminar 'departamentos'

    }
};
