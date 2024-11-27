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
        Schema::create('external_exits', function (Blueprint $table) {
            $table->id();
            $table->date('event_date');//data do evento
            $table->string('event_time');//hora do evento
            $table->date('departure_date')->nullable();//data da saída
            $table->string('departure_time')->nullable();//hora da saída
            $table->date('arrival_date')->nullable();//data da chegada
            $table->string('arrival_time')->nullable();//hora da chegada
            $table->string('status')->nullable();//status (mantida ou cancelada)
            $table->string('document')->nullable();//documento relacionado a saída
            $table->longText('remark')->nullable();//observaçoes sobre a escolta
            $table->string('user_create', 60)->nullable();
            $table->string('user_update', 60)->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreignId('prisoner_id')->constrained('prisoners')->cascadeOnDelete();//chave estrangeira do preso
            $table->foreignId('state_id')->constrained('states')->cascadeOnDelete();//chave estrangeira do estado
            $table->foreignId('municipality_id')->constrained('municipalities')->cascadeOnDelete();//chave estrangeira do município
            $table->foreignId('prison_unit_id')->constrained('prison_units')->cascadeOnDelete();//chave estrangeira do município
            $table->foreignId('requesting_id')->constrained('requestings')->cascadeOnDelete();//chave estrangeira do requisitante
            $table->foreignId('exit_reason_id')->constrained('exit_reasons')->cascadeOnDelete();//chave estrangeira do motivo da saída
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_exits');
    }
};
