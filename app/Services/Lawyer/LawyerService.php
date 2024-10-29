<?php

namespace App\Services\Lawyer;

use Illuminate\Support\Facades\Storage;

class LawyerService
{
   // converte em maiúsculo
   public function convertUppercase($dataValidated)
   {
       $dataValidated['lawyer'] = mb_strtoupper ($dataValidated['lawyer'],'utf-8');
       $dataValidated['register'] = mb_strtoupper ($dataValidated['register'],'utf-8');
       $dataValidated['contact'] = mb_strtoupper ($dataValidated['contact'],'utf-8');
       $dataValidated['remark'] = mb_strtoupper ($dataValidated['remark'],'utf-8');
       return $dataValidated;
   }

   // cadastro foto
   public function photoCreate($dataValidated)
   {
      /* responsável por excluir o documento */
      if (!empty($dataValidated['photo'])) {
         Storage::disk('public')->deleteDirectory('lawyer/register - '.$dataValidated['register']);
      }
      /* cria o nome da photo com a extensão */
      $photo_name = 'register'.' - '.$dataValidated['register'];
      /* faz o upload e retorna o endereco do arquivo */
      $dataValidated['photo'] = $dataValidated['photo']
         ->storeAs('lawyer/'.$photo_name, $photo_name.'.'.$dataValidated['photo']->getClientOriginalExtension());
      return $dataValidated;
   }
}