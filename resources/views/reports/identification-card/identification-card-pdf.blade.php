<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Atendimentos Internos</title>

   <style>
      *,
      *:after,
      *:before {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         text-decoration: none;
         font-family: Arial, Helvetica, sans-serif;
         font-size: 10px;
         border: 0;
      }

      body {
         margin: 0.7cm;
         font-size: 100%;
         list-style-type: none;
      }
   </style>
</head>

<body>
   <div style="width: 345px; height: 200px; border: 1px solid #52525b; padding: 8px; border-radius: 8px;">
      <div style="width: 100%;">
         <div style="width: 75%; float: left;">
            <div style="width: 100%; ">
               {{-- logo polícia penal --}}
               <div style="width: 20%; float: left;">
                  <span style="width: 100%;">
                     <img style="width: 100%; border-radius: 8px;"
                        src='{{ asset("storage/site/policia_penal_logo.png") }}'
                        alt="{{ $identification_card->visitant->name }}">
                  </span>
               </div>
               {{-- cabeçalho --}}
               <div style="width: 80%; text-align: center; float: right;">
                  <span style="font-size: 8px; display: block;">ESTADO DO TOCANTINS</span>
                  <span style="font-size: 9px; font-weight: bold; display: block;">SECRETARIA DA CIDADANIA E
                     JUSTIÇA</span>
                  <span style="font-size: 8px; display: block;">SUPERINTENDÊNCIA DE ADMINISTRAÇÃO
                     <br>PENITENCIÁRIO E PRISIONAL</span>
                  <span style="font-size: 20px; font-weight: bold; display: block;">UTPRBG</span>
                  <span style="font-size: 10px; font-weight: bold; display: block;">ARAGUAÍNA/TO</span>
               </div>
            </div>
            <div style="clear: both;"></div>
            {{-- identificação da carteirinha --}}
            <div
               style="background-color: #3f3f46; width: 97%;  margin-top: -12px; margin-bottom: 4px; border-radius: 8px;">
               <h1 style="color: #f4f4f5; font-size: 20px; font-weight: 700; padding: 2px; text-align: center;">{{
                  $identification_card->type }}</h1>
            </div>
         </div>
         {{-- foto do perfil --}}
         <div style="width: 25%; float: right;">
            <span style="width: 100%; height: 100%;">
               <img style="width: 100%; height: 55%; border-radius: 8px;"
                  src='{{ asset("storage/" . $identification_card->visitant->photo ) }}'
                  alt="{{ $identification_card->visitant->name }}">
            </span>
         </div>
      </div>
      <div style="clear: both;"></div>
      <div class="margin-bottom: 8px;">
         <span style="font-size: 10px; display: block;">VISITANTE: <strong style="font-size: 13px;">{{
               $identification_card->visitant->name
               }}</strong></span>
         <span style="font-size: 10px; margin-top: 5px; display: block;">REEDUCANDO: <strong style="font-size: 13px;">{{
               $identification_card->prisoner->name
               }}</strong></span>
         <div style="font-size: 10px; margin-top: 5px; display: block;">
            <span>
               PARENTESCO:
               <strong style="font-size: 13px;">
                  {{ $identification_card->degree_of_kinship->degree_of_kinship }}
               </strong>
            </span>

            <span style="float: right;">
               CPF:
               <strong style="font-size: 13px;">
                  {{ $identification_card->visitant->cpf }}
               </strong>
            </span>
         </div>

         <div style="margin-top: 8px;">
            <span style="font-size: 16px;">CÓD.: <strong style="font-size: 20px; color: #c81e1e;">{{
                  $identification_card->id }}
               </strong></span>
            <span style="margin-left: 64px; font-size: 16px;">VALIDADE: <strong
                  style="font-size: 20px; color: #c81e1e;">{{
                  \Carbon\Carbon::parse($identification_card->expiration_date)->format('d/m/Y') }}</strong></span>
         </div>
      </div>
   </div>

   <!-- lado 2 -->
   <div
      style="width: 345px; height: 200px; margin-top: 36px; float: left; border: 1px solid #52525b; padding: 8px; border-radius: 8px;">
      <div>
         <ul style="font-size: 12px; line-height: 16px; margin-top: 12px; margin-left: 8px;">
            <li>Esta carteira é de uso pessoal do titular e intransferível;</li>
            <li>É obrigatório a apresentação da identidade junto com esta carteira;</li>
            <li>A perda, furto ou extravio desta carteira deverá ser imediatamente comunicado à UTPRBG;</li>
            <li>O uso indevido por terceiros implicará na suspensão do direito de visita;</li>
            <li>É obrigatório a apresentação desta plastificada.</li>
         </ul>
      </div>
      <div
         style="margin-top: 64px; width: 75%; margin-left: auto; margin-right: auto; border-top: 1px solid #52525b; text-align: center; font-size: 10px;">
         DIRETOR DA UTPRBG
      </div>
   </div>
</body>

</html>