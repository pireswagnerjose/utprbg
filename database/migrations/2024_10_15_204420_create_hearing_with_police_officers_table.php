<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * delegate => delegado de polícia
     * police_station => delegacia de polícia
     * date_of_service => data do atendimento
     * time_of_service => hora do atendimento
     * status => status: mantido ou cancelado
     * remark => observação
     */
    public function up(): void
    {
        Schema::create('hearing_with_police_officers', function (Blueprint $table) {
            $table->id();
            $table->string('delegate');
            $table->string('police_station');
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
        Schema::dropIfExists('hearing_with_police_officers');
    }
};
