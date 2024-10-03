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
        Schema::create('visitant_documents', function (Blueprint $table) {
            $table->id();
            $table->string('document');//documento do visitante
            $table->string('title', 100);//titulo do documento
            $table->string('description', 255)->nullable();//descrição do documento
            $table->longText('remark')->nullable();//Observações sobre o documento

            $table->string('user_create', 100)->nullable();//usuário que criou o documento
            $table->string('user_update', 100)->nullable();//usuário que modificou o documento
            $table->string('prison_unit_id', 100);//unidade prisional

            /* chaves estrangeiras */
            $table->foreignId('visitant_id')->constrained('visitants')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitant_documents');
    }
};
