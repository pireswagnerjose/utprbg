<div class="w-full p-4 bg-white rounded-lg shadow dark:bg-zinc-800">
    <h1 class="text-base text-blue-700 uppercase font-bold mb-2">Períodos de Agendamentos de Visita</h1>
    <table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
            <tr class="text-center">
                <th scope="col" class="p-2 w-[5%]"> Cód </th>
                <th scope="col" class="p-2 w-[40%]"> Data Inicial </th>
                <th scope="col" class="p-2 w-[40%]"> Data Final </th>
                <th scope="col" class="p-2 w-[15%]"> Edit/Delete </th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $visit_scheduling_dates as $key=>$visit_scheduling_date )
            <tr
                class="odd:bg-white text-center text-base odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
                <td class="p-2"> {{ $key+1 }} </td>
                <td class="p-2"> {{ \Carbon\Carbon::parse($visit_scheduling_date->start_date)->format('d/m/Y') }} </td>
                <td class="p-2"> {{ \Carbon\Carbon::parse($visit_scheduling_date->end_date)->format('d/m/Y') }} </td>
                <td class="p-2">
                    <div class="flex w-full space-x-8 justify-center gap-8 ">
                        @can('update_visit_scheduling_date')
                        <button wire:click="modalUpdate({{ $visit_scheduling_date->id }})"
                            class="p-2 bg-green-700 hover:bg-green-800 dark:bg-green-600/50 dark:hover:bg-green-700/50 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-full dark:focus:ring-green-800">
                            <i data-lucide="pencil" class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></i>
                        </button>
                        @endcan

                        @can('delete_visit_scheduling_date')
                        <button wire:click="modalDelete({{ $visit_scheduling_date->id }})" wire:loading.attr="disabled"
                            class="p-2 bg-red-700 hover:bg-red-800 dark:bg-red-600/50 dark:hover:bg-red-700/50 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-full dark:focus:ring-red-800">
                            <i data-lucide="X" class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></i>
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
        {{ $visit_scheduling_dates->onEachSide(1)->links(data: ['scrollTo' => false]) }}
    </div>
</div>