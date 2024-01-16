<?php

namespace App\Livewire\Main\Prisoner;

class PrisonerAccessory
{
    
    // converte data para o padrão americano
    public function convertDate($dataValidated)
    {
        $dataValidated['date_birth'] = \Carbon\Carbon::createFromFormat('d/m/Y', $dataValidated['date_birth'])->format('Y-m-d');
        return $dataValidated;
    }

    // Transforma os caracteres em maiusculos
    public function convertUppercase($dataValidated)
    {
        $dataValidated['name'] = mb_strtoupper ($dataValidated['name'],'utf-8');
        $dataValidated['nickname'] = mb_strtoupper ($dataValidated['nickname'],'utf-8');
        $dataValidated['profession'] = mb_strtoupper ($dataValidated['profession'],'utf-8');
        $dataValidated['mother'] = mb_strtoupper ($dataValidated['mother'],'utf-8');
        $dataValidated['father'] = mb_strtoupper ($dataValidated['father'],'utf-8');
        return $dataValidated;
    }
}