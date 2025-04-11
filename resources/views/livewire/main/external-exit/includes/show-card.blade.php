@forelse ($external_exits as $external_exit)
    <div class="mx-auto border-b border-blue-400 dark:border-blue-600">
        <div class="flex z-10 w-full justify-between mt-2">
            @php
                $user_create = App\Models\User::where('id', $external_exit->user_create)->first();
                $user_update = App\Models\User::where('id', $external_exit->user_update)->first();
            @endphp

            <div class="flex gap-4 w-[70%]">
                <div class="flex text-xs">
                    <p class=" text-zinc-400 dark:text-zinc-600">Cadastrado por: </p>
                    <p class="text-blue-600 dark:text-blue-400">{{ $user_create->first_name }}
                        {{ $user_create->last_name }}</p>
                </div>
                <div class="flex text-xs">
                    @if (!empty($user_update))
                        <p class=" text-zinc-400 dark:text-zinc-600">Editador por: </p>
                        <p class="text-blue-600 dark:text-blue-400">{{ $user_update->first_name }}
                            {{ $user_update->last_name }}</p>
                    @endif
                </div>
            </div>

            {{-- botões --}}
            <div class="flex items-center justify-end w-[30%]">

                {{-- Editar --}}
                @can('update_external_exit')
                    <div class="group grid justify-items-center w-16">
                        <button wire:click="modalExternalExitUpdate({{ $external_exit->id }})"
                            class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
                            <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
                        </button>
                    </div>
                @endcan

                {{-- chama o modal para exclusão do item --}}
                @can('delete_external_exit')
                    <div class="group grid justify-items-center w-16">
                        <button wire:click="modalExternalExitDelete({{ $external_exit->id }})"
                            class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
                            <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
                        </button>
                    </div>
                @endcan

                {{-- Relatório PDF --}}
                <form action="{{ route('external-exit.report', ['external_exit_id' => $external_exit->id]) }}"
                    method="POST" target="_blank">
                    @csrf
                    <div class="group grid justify-items-center w-16">
                        <button
                            class="p-2 bg-green-500 dark:bg-green-400/50 hover:opacity-50 transition duration-500 rounded-full">
                            <x-lucide-file-text class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-file-text>
                        </button>
                    </div>
                </form>
            </div>
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

        <a class="realtive flex items-center" title='{{ $external_exit->document }}'
            href='{{ asset("storage/$external_exit->document") }}' rel='shadowbox[galeria]'>
            <dd class="font-semibold text-blue-700 dark:text-blue-500 hover:underline">DOCUMENTO RELACIONADO
                A SAÍDA
            </dd>
        </a>

        {{-- exclui o documento --}}
        <div class="group grid justify-items-center w-16">
            <button wire:click="modalDocumentDelete({{ $external_exit->id }})"
                class="p-1 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
                <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
            </button>
        </div>

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
