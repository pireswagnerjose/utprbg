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
        Schema::create('assistance_with_public_defenders', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_service');
            $table->string('time_of_service');
            $table->string('status');
            $table->longText('remark')->nullable();

            $table->string('user_create', 100)->nullable();//usuário que criou o documento
            $table->string('user_update', 100)->nullable();//usuário que modificou o documento
            $table->string('prison_unit_id', 100);//unidade prisional

            /* chaves estrangeiras */
            $table->foreignId('prisoner_id')->constrained('prisoners')->onDelete('cascade');
            $table->foreignId('public_defender_id')->constrained('public_defenders')->onDelete('cascade');
            $table->foreignId('modality_care_id')->constrained('modality_cares')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistance_with_public_defenders');
    }
};
