<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoteles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('localización');
            $table->string('dirección');
            $table->integer('estrellas');
            $table->json('servicios');
            $table->json('imagenes');
            $table->decimal('precio_noche', 10, 2);
            $table->integer('capacidad');
            $table->text('descripcion');
            $table->string('telefono');
            $table->string('email');
            $table->integer('habitaciones_disponibles');
            $table->boolean('disponible')->default(true);
            $table->date('fecha_apertura')->nullable();
            $table->date('fecha_cierre')->nullable();
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
        Schema::dropIfExists('hoteles');
    }
};
