<?php

namespace App\Livewire\Admin\PublicDefender\Traits;

trait PublicDefenderPropertiesRulesTrait
{
   public function rules()
   {
      if (!empty($this->public_defender_id)) {
         return [
               'public_defender'   => "required|max:255|unique:public_defenders,public_defender,{$this->public_defender_id},id",
               'contact'           => "required|max:15|min:15|unique:public_defenders,contact,{$this->public_defender_id},id",
               'prison_unit_id'    => 'required|max:10',
               'user_update'       => 'required|max:10',
         ];
      } else {
         return [
               'public_defender'   => 'required|max:255|unique:public_defenders,public_defender',
               'contact'           => "required|max:15|min:15|unique:public_defenders,contact",
               'prison_unit_id'    => 'required|max:10',
               'user_create'       => 'required|max:10',
         ];
      }
   }

   protected array $messages = [
      'public_defender.required'=> 'O campo Defensor Público é obrigatório.',
      'public_defender.max'=> 'O campo Defensor Público deve ter no máximo 255 caracteres.',
      'public_defender.unique'=> 'O campo Defensor Público deve ser único.',
      'contact.required'=> 'O campo Contato é obrigatório.',
      'contact.max'=> 'O campo Contato deve ter no máximo 15 caracteres.',
      'contact.min'=> 'O campo Contato deve ter no mínimo 15 caracteres.',
      'contact.unique'=> 'O campo Contato deve ser único.',
      'prison_unit_id.required'=> 'O campo é obrigatório.',
      'prison_unit_id.max'=> 'O campo deve ter no máximo 10 caracteres.',
      'user_create.required'=> 'O campo é obrigatório.',
      'user_create.max'=> 'O campo deve ter no máximo 10 caracteres.',
      'user_update.required'=> 'O campo é obrigatório.',
      'user_update.max'=> 'O campo deve ter no máximo 10 caracteres.',
  ];
}