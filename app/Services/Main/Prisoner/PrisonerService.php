<?php

namespace App\Services\Main\Prisoner;

class PrisonerService
{
   // Transforma os caracteres em maiusculos
   public function convertUppercase($data)
   {
       $data['name'] = mb_strtoupper ($data['name'],'utf-8');
       $data['nickname'] = mb_strtoupper ($data['nickname'],'utf-8');
       $data['profession'] = mb_strtoupper ($data['profession'],'utf-8');
       $data['mother'] = mb_strtoupper ($data['mother'],'utf-8');
       $data['father'] = mb_strtoupper ($data['father'],'utf-8');
       return $data;
   }
}