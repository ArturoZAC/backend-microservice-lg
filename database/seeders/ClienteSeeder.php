<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_PE'); // Faker con localización en Perú

        $mediosIngreso = ['facebook', 'whatsapp', 'google', 'instagram', 'post_venta', 'recomendacion', 'logos'];
        $sexos = ['masculino', 'femenino', 'otro'];
        $tiposDocumento = ['dni', 'ruc', 'dni_extranjeria'];

        for ($i = 1; $i <= 30; $i++) {
            DB::table('clientes')->insert([
                'nombres' => $faker->firstName,
                'apellidos' => $faker->lastName,
                'empresa' => $faker->company,
                'celular' => $faker->numerify('9########'),
                'password' => Hash::make('12345678'), // contraseña genérica
                'edad' => $faker->numberBetween(18, 65),
                'email' => $faker->unique()->safeEmail,
                'sexo' => $faker->randomElement($sexos),
                'medio_ingreso' => $faker->randomElement($mediosIngreso),
                'registro' => 'sistema',
                'tipo_documento' => $faker->randomElement($tiposDocumento),
                'numero_documento' => $faker->numerify('#########'),
                'estado' => 1,
                'antiguo' => 1,
                'puntuacion' => $faker->numberBetween(0, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
