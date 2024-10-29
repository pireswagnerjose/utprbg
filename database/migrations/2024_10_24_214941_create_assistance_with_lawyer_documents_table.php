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
        Schema::create('assistance_with_lawyer_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('path');

            $table->string('user_create', 100)->nullable();//usuário que criou o documento
            $table->string('user_update', 100)->nullable();//usuário que modificou o documento
            $table->string('prison_unit_id', 100);//unidade prisional

            /* chaves estrangeiras */
            $table->foreignId('pk_a_w_l_id')->constrained('assistance_with_lawyers');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistance_with_lawyer_documents');
    }
};
