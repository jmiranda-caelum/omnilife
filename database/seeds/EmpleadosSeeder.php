<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmpleadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 5; $i++) { 
	        DB::table('empleados')->insert([
	            'codigo' => Str::random(20),
				'nombre' => Str::random(15),
				'salarioDolares' => rand(11111,99999),
				'direccion' => Str::random(30),
				'estado' => Str::random(10),
				'ciudad' => Str::random(10),
				'telefono' => rand(1111111111,9999999999),
				'correo' => Str::random(8).'@gmail.com',
				'activo' => 1,
	        ]);
    	}
    }
}
