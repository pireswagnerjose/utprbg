@forelse ($external_exits as $external_exit)
    <div class="mx-auto p-4 relative border-b border-blue-400 dark:border-blue-600">
        {{-- botões --}}
        <div class="flex z-10 absolute w-full items-center justify-end pr-6">

            {{-- Editar --}}
            <div class="group grid justify-items-center w-16 border-b border-zinc-200 dark:border-zinc-600">
                <button wire:click="modalExternalExitUpdate({{ $external_exit->id }})" class="w-8 h-8 bg-blue-600 dark:bg-blue-500 rounded-full p-2">
                    <svg class=" w-4 h-4 text-blue-50 dark:text-blue-50 hover:text-blue-400 hover:dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.109 17H1v-2a4 4 0 0 1 4-4h.87M10 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm7.95 2.55a2 2 0 0 1 0 2.829l-6.364 6.364-3.536.707.707-3.536 6.364-6.364a2 2 0 0 1 2.829 0Z" />
                    </svg>
                </button>
                <span class="text-xs text-zinc-600 dark:text-zinc-400">Editar</span>
            </div>

            {{-- chama o modal para exclusão do item --}}
            @can('admin')
                <div class="group grid justify-items-center w-16 border-b border-zinc-200 dark:border-zinc-600">
                    <button wire:click="modalExternalExitDelete({{ $external_exit->id }})" class="w-8 h-8 bg-red-600 dark:bg-red-500 rounded-full p-2">
                        <svg class="w-4 h-4 text-red-50 dark:text-red-50 hover:text-red-400 hover:dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 8h6m-9-3.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                        </svg>
                    </button>
                    <span class="text-xs text-zinc-600 dark:text-zinc-400">Excluir</span>
                </div> 
            @endcan

            {{-- Relatório PDF --}}
            <form action="{{ route('external-exit.report', ['external_exit_id' => $external_exit->id]) }}" method="POST" target="_blank">
                @csrf
                <div class="group grid justify-items-center w-16 border-b border-zinc-200 dark:border-zinc-600">
                    <button class="w-8 h-8 bg-green-600 dark:bg-green-500 rounded-full p-2">
                        <svg class="w-4 h-4 text-green-50 dark:text-green-50 hover:text-green-400 hover:dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9v-5h1.5a1.5 1.5 0 1 1 0 3H1m12 2v-5h2m-2 3h2m-8-3v5h1.375A1.626 1.626 0 0 0 10 13.375v-1.75A1.626 1.626 0 0 0 8.375 10H7Z"/>
                        </svg>
                    </button>
                    <span class="text-xs text-zinc-600 dark:text-zinc-400 ">Extramuro</span>
                </div>
            </form>
        </div>

        {{-- linha 1 --}}
        <div class="grid grid-cols-5 gap-4 mb-5">
            <div class="col-span-2">
                <x-item-topic>Unidade Prisional</x-item-topic>
                <div class="text-base font-medium uppercase">{{ $external_exit->prison_unit->prison_unit }}</div>
            </div>
            <div class="col-span-2">
                <x-item-topic>Requisitante</x-item-topic>
                <div class="text-base font-medium uppercase">{{ $external_exit->requesting->requesting }}</div>
            </div>
        </div>

        {{-- linha 2 --}}
        <div class="grid grid-cols-4 gap-4 mb-5">
            <div>
                <x-item-topic>Data do Evento</x-item-topic>
                @empty(!$external_exit->event_date)
                    <x-item-data>{{ \Carbon\Carbon::parse($external_exit->event_date)->format('d/m/Y') }}</x-item-data>
                @endempty
            </div>

            <div class="">
                <x-item-topic>Hora do Evento</x-item-topic>
                <div class="text-base font-medium uppercase">{{ $external_exit->event_time }}</div>
            </div>

            <div class="">
                <x-item-topic>Motivo da Saída</x-item-topic>
                <div class="text-base font-medium uppercase">{{ $external_exit->exit_reason->exit_reason }}</div>
            </div>
            <div>
                <x-item-topic>Status</x-item-topic>
                @if ($external_exit->status == 'CANCELADO')
                    <div class="text-base font-semibold text-red-700 uppercase">{{ $external_exit->status }}</div>
                @else
                    <div class="text-base font-semibold text-green-700 uppercase">{{ $external_exit->status }}</div>
                @endif
            </div>
        </div>

        {{-- Linha3 --}}
        <div class="grid grid-cols-4 gap-4 mb-5">
            <div>
                <x-item-topic>Data da Saída</x-item-topic>
                @empty(!$external_exit->departure_date)
                    <x-item-data>{{ \Carbon\Carbon::parse($external_exit->departure_date)->format('d/m/Y') }}</x-item-data>
                @endempty
            </div>
            <div>
                <x-item-topic>Hora da Saída</x-item-topic>
                <x-item-data>{{ $external_exit->departure_time }}</x-item-data>
            </div>
            <div>
                <x-item-topic>Data do Retorno</x-item-topic>
                @empty(!$external_exit->arrival_date)
                    <x-item-data>{{ \Carbon\Carbon::parse($external_exit->arrival_date)->format('d/m/Y') }}</x-item-data>
                @endempty
            </div>
            <div>
                <x-item-topic>Hora do Retorno</x-item-topic>
                <x-item-data>{{ $external_exit->arrival_time }}</x-item-data>
            </div>
        </div>

        {{-- Linha 3 --}}
        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <x-item-topic>Estado</x-item-topic>
                <x-item-data>{{ $external_exit->state->state }}</x-item-data>
            </div>
            <div>
                <x-item-topic>Município</x-item-topic>
                <x-item-data>{{ $external_exit->municipality->municipality }}</x-item-data>
            </div>
        </div>

        {{-- Linha 4 --}}
        <div class="grid grid-cols-6 gap-4 mb-5 items-center">
            <div class="col-span-4">
                <x-item-topic>Observações</x-item-topic>
                <x-item-data class="text-justify">{{ $external_exit->remark }}</x-item-data>
            </div>
            @if ($external_exit->document != null)
                <div class="col-span-2 text-sm uppercase font-medium flex justify-end">
                    <a class="realtive flex items-center" title='{{ $external_exit->document }}' href='{{ asset("storage/$external_exit->document") }}' rel='shadowbox[galeria]'>
                        <dd class="font-semibold text-blue-700 dark:text-blue-500 hover:underline">DOCUMENTO RELACIONADO A SAÍDA</dd>
                    </a>
                </div>
            @endif
        </div>
    </div>
    @empty
        {{-- mensagem exibina de não houver dados --}}
        <div class="flex items-center dark:text-white dark:divide-gray-700">
            <dd class="md:text-sm text-center font-normal text-gray-700 dark:text-gray-100">
                Não existe saídas externas cadastrada para esse preso
            </dd>
        </div>
@endforelse