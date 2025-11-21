<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            // Datos del cliente
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('empresa')->nullable();
            $table->string('celular')->nullable();
            $table->string('password')->nullable();
            $table->integer('edad')->nullable();
            $table->string('email')->unique();

            //ENUMS
            //------
            $table->enum('sexo', ['masculino', 'femenino', 'otro'])->nullable();
            $table->enum('medio_ingreso', [
                'Facebook',
                'Whatsapp',
                'Google',
                'Instagram',
                'Post Venta',
                'Recomendacion',
                'Logos'
            ])->nullable();
            $table->enum('registro', ['sistema', 'pagina_web'])->default('sistema');
            $table->enum('tipo_documento', ['dni', 'ruc', 'dni_extranjeria']);
            //------    
            $table->string('numero_documento');
            $table->integer('estado')->default(1);
            $table->integer('antiguo')->default(1);
            $table->integer('puntuacion')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
