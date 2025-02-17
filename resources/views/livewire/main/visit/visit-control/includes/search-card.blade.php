<div class="w-full p-4 bg-white rounded-lg shadow dark:bg-zinc-800">
  <h1 class="text-base text-blue-700 uppercase font-bold mb-2">Controle de Visita</h1>
  <table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
      <tr class="text-center">
        <th scope="col" class="p-2 w-[5%]"> # </th>
        <th scope="col" class="p-2 w-[15%]"> Data da Vista </th>
        <th scope="col" class="p-2 w-[15%]"> Número de Visitas </th>
        <th scope="col" class="p-2 w-[15%]"> Qtd. Agendadas </th>
        <th scope="col" class="p-2 w-[25%]"> Tipo da Visita </th>
        <th scope="col" class="p-2 w-[25%]"> Ala - Pavilhão </th>
        <th scope="col" class="p-2 w-[15%]"> Edit/Delete </th>

      </tr>
    </thead>
    <tbody>
      @forelse ( $visit_controls as $key=>$visit_control )
      <tr
        class="odd:bg-white text-center text-base odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
        <td class="p-2"> {{ $key+1 }} </td>
        <td class="p-2"> {{ \Carbon\Carbon::parse($visit_control->date)->format('d/m/Y') }} </td>
        <td class="p-2"> {{ $visit_control->number_visit }} </td>
        @php
        $visit_schedulin_count = App\Models\Main\Visit\VisitScheduling::where('date_visit',
        $visit_control->date)->count();
        @endphp
        <td class="p-2"> {{ $visit_schedulin_count }} </td>
        <td class="p-2"> {{ $visit_control->visit_type }} </td>
        <td class="p-2"> {{ $visit_control->ward->ward }} </td>
        <td class="p-2">
          <div class="flex w-full space-x-8 justify-center gap-8 ">
            @can('update_visit_control')
            <button wire:click="modalUpdate({{ $visit_control->id }})"
              class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
              <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
            </button>
            @endcan

            @can('delete_visit_control')
            <button wire:click="modalDelete({{ $visit_control->id }})" wire:loading.attr="disabled"
              class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
              <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
            </button>
            @endcan
          </div>
        </td>
      </tr>
      @empty
      <td class="p-2"> Não existe agendamentos feitos. </td>
      @endforelse
    </tbody>
  </table>
  {{-- paginação --}}
  <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
    {{ $visit_controls->onEachSide(1)->links() }}
  </div>
</div>