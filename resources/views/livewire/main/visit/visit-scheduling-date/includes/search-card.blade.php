<div class="w-full p-4 bg-white rounded-lg shadow dark:bg-zinc-800">
    <h1 class="text-base text-blue-700 uppercase font-bold mb-2">Períodos de Agendamentos de Visita</h1>
    <table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
            <tr class="text-center">
                <th scope="col" class="p-2 w-[5%]"> Cód </th>
                <th scope="col" class="p-2 w-[40%]"> Data Inicial </th>
                <th scope="col" class="p-2 w-[40%]"> Data Final </th>
                <th scope="col" class="p-2 w-[15%]"> Edit </th>
                
            </tr>
        </thead>
        <tbody>
            @forelse ( $visit_scheduling_dates as $key=>$visit_scheduling_date )
                <tr class="odd:bg-white text-center text-base odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
                    <td class="p-2"> {{ $key+1 }} </td>
                    <td class="p-2"> {{ \Carbon\Carbon::parse($visit_scheduling_date->start_date)->format('d/m/Y') }} </td>
                    <td class="p-2"> {{ \Carbon\Carbon::parse($visit_scheduling_date->end_date)->format('d/m/Y') }} </td>
                    <td class="p-2">
                        <div class="flex w-full space-x-8 justify-center gap-8 ">
                            <button wire:click="modalUpdate({{ $visit_scheduling_date->id }})" class="text-sm text-teal-500 font-semibold rounded hover:text-teal-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                            
                            <button wire:click="modalDelete({{ $visit_scheduling_date->id }})" wire:loading.attr="disabled" class="text-sm text-red-500 font-semibold rounded hover:text-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
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
        {{ $visit_scheduling_dates->onEachSide(1)->links() }}
    </div>
</div>