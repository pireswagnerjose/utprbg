<x-report-layout>
   <style>
      @page {
          size: A4 landscape;
      }
  </style>
   <div style="text-align: center; margin: 20px 0;">
      
     <strong>VCAM </strong>
     <span>- {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} a {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</span>
   </div>

   <table cellspacing="0" rules="none" style="font-size: 11px; font-stretch: condensed; width: 100%">
      <thead>
         <tr style="background-color: #000; color: #ccc">
            <th scope="col" style="width: 5%">
               CÓD.
            </th>
            <th scope="col" class="name" style="width: 50%">
               NOME
            </th>
            <th scope="col" class="date" style="width: 15%">
               DT. ENTRADA
            </th>
            <th scope="col" class="ward" style="width: 15%">
               DT. SAÍDA
            </th>
            <th scope="col" class="cell" style="width: 15%">
               DIÁRIAS
            </th>
            <th scope="col" class="cell" style="width: 15%">
               VR. DIÁRIA
            </th>
            <th scope="col" class="cell" style="width: 15%">
               VR. TOTAL
            </th>
         </tr>
      </thead>
      <tbody>

         @foreach ($prisons as $indice => $prison)
         <tr style="border: 1px solid #ccc">

            <td style="text-align: center; padding: 0 2px">
               <p> {{ $indice + 1 }} </p>
            </td>

            <td style="padding: 0 2px">
               <p> {{ $prison->prisoner->name }} </p>
            </td>

            <td style="text-align: center;">
               {{ \Carbon\Carbon::parse($prison->entry_date)->format('d/m/Y') }}</p>
            </td>

            <td style="text-align: center;">
               @if (!empty($prison->exit_date))
                  <p>{{ \Carbon\Carbon::parse($prison->exit_date)->format('d/m/Y') }}</p>
               @endif
            </td>

            <td style="text-align: center;">
               @php
                  // retorna o a data de entrada do preso na unidade
                  $data_entry = \Carbon\Carbon::parse($prison->entry_date);

                  // retorna a data de saída do preso da unidade
                  if (!empty($prison->exit_date)) {
                     $exit_date = \Carbon\Carbon::parse($prison->exit_date);
                  }
                  
                  // retorna o primeiro dia do mês para cálculo
                  $first_day = \Carbon\Carbon::parse($start_date);

                  // retorna o último dia do mês para cálculo = 30 ou 31
                  $last_day = \Carbon\Carbon::parse($end_date);
                  
                  if (!empty($prison->exit_date)) {
                     if ($first_day->diffInDays($exit_date) < $first_day->diffInDays($last_day)) {
                        $days = $first_day->diffInDays($exit_date) + 1;
                     } elseif ($data_entry->diffInDays($last_day) < $first_day->diffInDays($last_day)) {
                        $days = $data_entry->diffInDays($last_day) + 1;
                     } else {
                        $days = $first_day->diffInDays($last_day) + 1;
                     }
                  } else {
                     if ($data_entry->diffInDays($last_day) < $first_day->diffInDays($last_day)) {
                        $days = $data_entry->diffInDays($last_day) + 1;
                     } else {
                        $days = $first_day->diffInDays($last_day) + 1;
                     }
                  }
               @endphp
               <p>{{ $days }}</p>
            </td>

            @php
               $d1 = 5543.98 / 30;
               $d2 = 5543.98 / 31;
               $valor30 = $d1  * $days;
               $valor31 = $d2 * $days;
            @endphp

            <td style="text-align: center;">
               @if ($days == 31)
                  <p>{{  number_format($d2, 2, ',', '.') }}</p>
               @else
                  <p>{{ number_format($d1, 2, ',', '.') }}</p>
               @endif
               
            </td>

            <td style="text-align: center;">
               @if ($days == 31)
                  <p>{{  number_format($valor31, 2, ',', '.') }}</p>
               @else
                  <p>{{ number_format($valor30, 2, ',', '.') }}</p>
               @endif
            </td>

         </tr>
         @endforeach

      </tbody>
   </table>

</x-report-layout>