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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Reutilización del campo email
            |--------------------------------------------------------------------------
            |
            | En la lógica tradicional cuando se crea un usuario el campo email es único para que no se creen registros duplicados,
            | el problema aparece cuando se elimina un registro y se trata de guardar nuevamente por lo que ocasionara un error en base de datos por el email,
            | una forma de solucionar este problema es que cuando se elimine el registro actualizar el email y agregarle la fecha de cuando fue eliminado,
            | pero existe una mejor(para mí), que es hacer que la columna email y deleted_at sean únicos y nos evita estar haciendo otros trucos.
            */
            $table->unique(['email', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
