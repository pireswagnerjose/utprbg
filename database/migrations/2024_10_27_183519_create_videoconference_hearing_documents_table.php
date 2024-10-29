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
        Schema::create('videoconference_hearing_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('path');

            $table->string('user_create', 100)->nullable();//usuário que criou o documento
            $table->string('user_update', 100)->nullable();//usuário que modificou o documento
            $table->string('prison_unit_id', 100);//unidade prisional

            /* chaves estrangeiras */
            $table->foreignId('pk_v_h_id')->constrained('videoconference_hearing_documents');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videoconference_hearing_documents');
    }
};
