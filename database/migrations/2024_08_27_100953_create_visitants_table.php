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
        Schema::create('visitants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);//nome do visitante
            $table->string('photo', 100);//foto do visitante
            $table->string('cpf', 14);//cpf
            $table->string('address', 255);//endereço atualizado
            $table->string('phone', 100);//telefone atualizado
            $table->string('status', 10);//status se ativo ou inativo
            $table->longText('remark')->nullable();//observações sobre o visitante
            
            $table->string('user_create', 100);//usuário que criou o documento
            $table->string('user_update', 100);//usuário que modificou o documento
            $table->string('prison_unit_id', 100);//unidade prisional

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitants');
    }
};
