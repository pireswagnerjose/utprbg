<x-report-layout>
   <div style="text-align: center; margin: 20px 0;">
      <?php $date = new DateTimeImmutable();
      echo '<strong>LISTAGEM DE INTERNOS </strong> - Data: '.$date->format('d-m-Y'); ?>
  </div>
  <div>
   @if ($ward) 
      <h1 style="text-align: center; border-bottom: 1px solid #666; font-size: 20px; font-stretch: condensed">{{ $ward->ward }}</h1>
   @endif
  </div>
   <table cellspacing="0" rules="none" style="font-size: 11px; font-stretch: condensed">
      <thead>
          <tr>
              @if ($c_s_photo == 1)
              <th scope="col" style="width: 70px">
                  FOTO
              </th>
              @else
              <th scope="col" style="width: 70px">
                  CÓD.
              </th>
              @endif
              <th scope="col" class="name" style="width: 350px">
                  NOME 
              </th>
              <th scope="col" class="date" style="width: 90px">
                  DT. ENTRADA
              </th>
              <th scope="col" class="ward" style="width: 100px">
                  PAVILHÃO 
              </th>
              <th scope="col" class="cell" style="width: 100px">
                  CELA
              </th>
          </tr>
      </thead>
      <tbody>
          @forelse ($unit_addresses as $unit_address)
              <tr style="border: 1px solid #ccc">
                  @if ($c_s_photo == 1)
                      <td style="text-align: center; height: 70px; padding: 2px">
                          <img src="{{ storage_path('app/public/'.$unit_address->prisoner->photo) }}" width="70" alt="Neil image">
                      </td>
                  @else
                      <td style="text-align: center; padding: 0 2px">
                          <p> {{ $unit_address->prisoner_id }} </p>
                      </td>
                  @endif
                  <td style="text-align: center;">
                      <p>{{ $unit_address->prisoner->name }}</p>
                  </td>
                  @php
                      $prison = $prisons->where('prisoner_id', $unit_address->prisoner_id)->orderBy('entry_date', 'desc')->first();
                  @endphp
                  <td style="text-align: center;">
                      <p>{{ \Carbon\Carbon::parse($prison->entry_date)->format('d/m/Y') }}</p>
                  </td>
                  <td style="text-align: center;">
                      @isset($unit_address->ward)
                          <p>{{ $unit_address->ward->ward }}</p>
                      @endisset
                  </td>
                  <td style="text-align: center;">
                      @isset($unit_address->cell)
                          <p>{{ $unit_address->cell->cell }}</p> 
                      @endisset
                  </td>
              </tr>
              @empty
              <div class="grid col-span-3 p-4 leading-normal">
                  <h5 class="w-full text-center mb-2 text-xl font-medium tracking-tight text-red-700 dark:text-yellow-300">
                      Não foram encontrados registros na sua pesquisa!
                  </h5>
              </div>
          @endforelse
      </tbody>
  </table>
   
</x-report-layout>