<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * public_defender => defensor público
     * contact => contato
     */
    public function up(): void
    {
        Schema::create('public_defenders', function (Blueprint $table) {
            $table->id();
            $table->string('public_defender')->unique();
            $table->string('contact')->unique()->nullable();

            $table->string('user_create', 100)->nullable();//usuário que criou o documento
            $table->string('user_update', 100)->nullable();//usuário que modificou o documento
            $table->string('prison_unit_id', 100);//unidade prisional

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_defenders');
    }
};
