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
        Schema::create('visitants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);//nome do visitante
            $table->string('photo', 255);//foto do visitante
            $table->string('cpf', 14);//cpf
            $table->date('date_of_birth')->nullable();//Data de Nascimento 00/00/0000
            $table->string('phone', 100);//telefone atualizado
            $table->string('street', 255);//rua
            $table->string('number', 50)->nullable();//número
            $table->string('complement', 255)->nullable();//complemento
            $table->string('barrio', 255)->nullable();//bairro
            $table->string('type_of_residence', 255)->nullable();//tipo de residência (própria, alugada, cedida)
            $table->string('status', 10);//status se ativo ou inativo
            $table->longText('remark')->nullable();//observações sobre o visitante
            
            $table->string('user_create', 100)->nullable();//usuário que criou o documento
            $table->string('user_update', 100)->nullable();//usuário que modificou o documento
            $table->string('prison_unit_id', 100);//unidade prisional

            //CHAVES ESTRANGEIRAS
            $table->foreignId('civil_status_id')->constrained('civil_statuses');//estado civil
            $table->foreignId('sex_id')->constrained('sexes');//sexo
            $table->foreignId('municipality_id')->constrained('municipalities');//município
            $table->foreignId('state_id')->constrained('states');//estado

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitants');
    }
};
