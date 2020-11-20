<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',40)->nullable(false);
            $table->string('nombre',120)->nullable(false);
            $table->double('salarioDolares', 15, 8);
            $table->double('salarioPesos', 15, 8)->nullable(true);
            $table->string('direccion',250)->nullable(false);
            $table->string('estado',50)->nullable(false);
            $table->string('ciudad',50)->nullable(false);
            $table->string('telefono',10)->nullable(false);
            $table->string('correo',100)->nullable(false);
            $table->tinyInteger('activo')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
