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
        Schema::create('identification_cards', function (Blueprint $table) {
            $table->id();//numero da carteirinha
            $table->string('date_of_creation');//data da criaçao da carteirinha
            $table->string('expiration_date');//data de validade da carteirinha
            $table->string('status');//status ativa ou suspensa
            $table->longText('remark')->nullable();//observações sobre a carteirinha
            
            $table->string('user_create', 100);//usuário que criou o documento
            $table->string('user_update', 100);//usuário que modificou o documento
            $table->string('prison_unit_id', 100);//unidade prisional

            /* chaves estrangeiras */
            $table->foreignId('prisoner_id')->constrained('prisoners')->onDelete('cascade');
            $table->foreignId('visitant_id')->constrained('visitants')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identification_cards');
    }
};