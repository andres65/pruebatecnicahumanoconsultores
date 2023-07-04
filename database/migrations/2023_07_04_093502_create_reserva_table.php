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
        Schema::create('reserva', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habitacion_id');
            $table->integer('dias');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedBigInteger('cliente_id');
            $table->boolean('estado')->default(1);
            $table->unsignedBigInteger('empleado_id');

            $table->foreign('habitacion_id')->references('id')->on('habitaciones')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva');
    }
};
