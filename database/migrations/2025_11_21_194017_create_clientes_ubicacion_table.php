<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes_ubicacion', function (Blueprint $table) {
            $table->id();

            // Relación con clientes
            $table->foreignId('cliente_id')
                  ->constrained('clientes')
                  ->onDelete('cascade');

            // Región
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();

            // Métricas
            $table->string('pais')->nullable();
            $table->string('departamento')->nullable();
            $table->string('distrito')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes_ubicacion');
    }
};
