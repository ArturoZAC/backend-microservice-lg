<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes_contactos', function (Blueprint $table) {
            $table->id();

            // Relación con clientes
            $table->foreignId('cliente_id')
                  ->constrained('clientes')
                  ->onDelete('cascade');

            // Datos del contacto
            $table->string('nombres');
            $table->string('celular')->nullable();
            $table->string('correo')->nullable();

            // Documento
            $table->enum('tipo_documento', ['dni', 'ruc', 'dni_extranjeria'])->nullable();
            $table->string('numero_documento')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes_contactos');
    }
};
