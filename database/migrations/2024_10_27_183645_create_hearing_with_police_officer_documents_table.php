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
        Schema::create('hearing_with_police_officer_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('path');

            $table->string('user_create', 100)->nullable();//usuário que criou o documento
            $table->string('user_update', 100)->nullable();//usuário que modificou o documento
            $table->string('prison_unit_id', 100);//unidade prisional

            /* chaves estrangeiras */
            $table->foreignId('pk_h_p_o_id')->constrained('hearing_with_police_officers');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hearing_with_police_officer_documents');
    }
};
