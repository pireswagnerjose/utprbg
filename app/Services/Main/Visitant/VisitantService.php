<?php

namespace App\Services\Main\Visitant;

class VisitantService
{
   // Transforma os caracteres em maiusculos
   public function convertUppercase($data)
   {
      $data['name'] = mb_strtoupper ($data['name'],'utf-8');
      $data['street'] = mb_strtoupper ($data['street'],'utf-8');
      $data['complement'] = mb_strtoupper ($data['complement'],'utf-8');
      $data['barrio'] = mb_strtoupper ($data['barrio'],'utf-8');
      $data['type_of_residence'] = mb_strtoupper ($data['type_of_residence'],'utf-8');
      $data['status'] = mb_strtoupper ($data['status'],'utf-8');
      $data['remark'] = mb_strtoupper ($data['remark'],'utf-8');
      return $data;
   }
}