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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->unsignedBigInteger('tipo_documento_id');
            $table->string('documento')->unique();
            $table->string('email')->unique();
            $table->date('fecha_nacimiento');
            $table->string('rol');
            $table->boolean('estado')->default(1);

            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documentos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
