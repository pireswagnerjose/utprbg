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
        Schema::create('booking_visits', function (Blueprint $table) {
            $table->id();
            $table->date('date');//Data do Agendamento
            $table->string('type', 10);//Tipo da visita (íntima ou social)
            $table->string('status', 60)->nullable();//Mantida ou cancelada
            $table->string('identification_card_id', 60);//número da carteirinha
            $table->string('phone_contact', 60);//telefone para contato
            $table->longText('remark')->nullable();//Observações sobre o agendamento

            $table->string('user_create', 100)->nullable();//usuário que criou o documento
            $table->string('user_update', 100)->nullable();//usuário que modificou o documento
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
        Schema::dropIfExists('booking_visits');
    }
};
