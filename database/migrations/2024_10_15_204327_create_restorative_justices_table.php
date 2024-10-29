<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * facilitator_conciliator => facilitador/conciliador
     * date_of_service => data do atendimento
     * time_of_service => hora do atendimento
     * status => status: mantido ou cancelado
     * remark => observação
     * prisoner_id => código do preso
     * modality_care_id => código do tipo do atendimento
     * 
     */
    public function up(): void
    {
        Schema::create('restorative_justices', function (Blueprint $table) {
            $table->id();
            $table->string('facilitator_conciliator');
            $table->date('date_of_service');
            $table->string('time_of_service');
            $table->string('status');
            $table->longText('remark')->nullable();

            $table->string('user_create', 100)->nullable();//usuário que criou o documento
            $table->string('user_update', 100)->nullable();//usuário que modificou o documento
            $table->string('prison_unit_id', 100);//unidade prisional

            /* chaves estrangeiras */
            $table->foreignId('prisoner_id')->constrained('prisoners')->onDelete('cascade');
            $table->foreignId('modality_care_id')->constrained('modality_cares')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restorative_justices');
    }
};
