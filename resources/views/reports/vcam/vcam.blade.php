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
               VR. DIARIAS
            </th>
         </tr>
      </thead>
      <tbody>

         @foreach ($prisons as $indice => $prison)
         <tr style="border: 1px solid #ccc">

            <td style="text-align: center; padding: 0 2px">
               <p> {{ $indice }} </p>
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
                  $start = $prison->entry_date;
                  $end = $prison->exit_date;
                  $data_entry = \Carbon\Carbon::createFromFormat('Y-m-d', $start);

                  $data_entry_2 = \Carbon\Carbon::createFromFormat('Y-m-d', $start_date);
                  $data_exit_2 = \Carbon\Carbon::createFromFormat('Y-m-d', $end_date);
                  
                  if (!empty($end)) {
                     $data_exit = \Carbon\Carbon::createFromFormat('Y-m-d', $end);
                  } else {
                     $data_exit = \Carbon\Carbon::createFromFormat('Y-m-d', $end_date);
                  }
                  
                  if ($data_entry->diffInDays($data_exit) >= $data_entry_2->diffInDays($data_exit_2)) {
                     $days = $data_entry_2->diffInDays($data_exit_2) + 1;
                  } else {
                     $days = $data_entry->diffInDays($data_exit) + 1;
                  }
               @endphp
               <p>{{ $days }}</p>
            </td>

            <td style="text-align: center;">
               @php
                  $d1 = 5543.98 / 30;
                  $d2 = 5543.98 / 31 * $days;
                  $valor30 = number_format($d1, 2);
                  $valor31 = number_format($d2, 2);
               @endphp
               <p>{{ $valor31 }}</p>
            </td>

         </tr>
         @endforeach

      </tbody>
   </table>

</x-report-layout>