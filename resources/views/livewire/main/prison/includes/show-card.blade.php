@forelse ($prisons as $prison)
        <div class="mx-auto p-4 relative border-b border-blue-400 dark:border-blue-600">
            {{-- botões --}}
            <div class="flex z-10 absolute w-full space-x-8 items-center justify-end pr-6">
                <button wire:click="modalPrisonUpdate({{ $prison->id }})" class="text-sm text-teal-500 font-semibold rounded hover:text-teal-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </button>

                <button wire:click="modalPrisonDelete({{ $prison->id }})" wire:loading.attr="disabled" class="text-sm text-red-500 font-semibold rounded hover:text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </div>
            {{-- linha 1 --}}
            <div class="grid grid-cols-5 gap-4 mb-5">
                <div class="col-span-2">
                    <div class="font-light text-sm text-zinc-500">Unidade Prisional</div>
                    <div class="text-base font-medium uppercase">{{ $prison->prison_unit->prison_unit }}</div>
                </div>
                <div class="">
                    <div class="font-light text-sm text-zinc-500">Data de Entrada</div>
                    @empty(!$prison->entry_date)
                        <div class="text-base font-medium uppercase">{{ \Carbon\Carbon::parse($prison->entry_date)->format('d/m/Y') }}</div>
                    @endempty
                </div>
                <div class="">
                    <div class="font-light text-sm text-zinc-500">Data de Saída</div>
                    @empty(!$prison->exit_date)
                        <div class="text-base font-medium uppercase">{{ \Carbon\Carbon::parse($prison->exit_date)->format('d/m/Y') }}</div>
                    @endempty
                </div>
            </div>
            {{-- linha 2 --}}
            <div class="grid grid-cols-3 gap-4 mb-5">
                <div class="">
                    <div class="font-light text-sm text-zinc-500">Pena (em anos, meses e dias)</div>
                    <div class="text-base font-medium uppercase">{{ $prison->sentence }}</div>
                </div>
                <div class="">
                    <div class="font-light text-sm text-zinc-500">Previsão de Saída</div>
                    @empty(!$prison->exit_forecast)
                        <div class="text-base font-medium uppercase">{{ \Carbon\Carbon::parse($prison->exit_forecast)->format('d/m/Y') }}</div>
                    @endempty
                </div>
                <div class="">
                    <div class="font-light text-sm text-zinc-500">Data do Último Atestado de Pena</div>
                    @empty(!$prison->sentence_certificate)
                        <div class="text-base font-medium uppercase">   {{ \Carbon\Carbon::parse($prison->sentence_certificate)->format('d/m/Y') }}</div>
                    @endempty
                </div>
            </div>
            {{-- linha 3 --}}
            <div class="grid grid-cols-3 gap-4 mb-5">
                <div class="">
                    <div class="font-light text-sm text-zinc-500">Origem da Prisão</div>
                    <div class="text-base font-medium uppercase">{{ $prison->prison_origin->prison_origin }}</div>
                </div>
                <div class="">
                    <div class="font-light text-sm text-zinc-500">Tipo da Prisão</div>
                    <div class="text-base font-medium uppercase">{{ $prison->type_prison->type_prison }}</div>
                </div>
                <div class="">
                    <div class="font-light text-sm text-zinc-500">Tipo da Saída</div>
                    @empty(!$prison->output_type_id)
                        <div class="text-base font-medium uppercase">{{ $prison->output_type->output_type }}</div>
                    @endempty
                </div>
            </div>

            {{-- linha 4 --}}
            <div class="grid mb-5">
                <div class="font-light text-sm text-gray-500">
                    Documentos Relacionados
                    <div class="px-4">
                        <livewire:main.prison.prison-document-livewire :prison_id="$prison->id" :prisoner_id="$prisoner_id" />
                    </div>
                </div>
            </div>
            
            {{-- linha 5 --}}
            <div class="">
                <div class="">
                    <div class="font-light text-sm text-zinc-500">Observações</div>
                    <div class="text-base font-medium uppercase">{{ $prison->remarks }}</div>
                </div>
            </div>
        </div>
    @empty
        {{-- mensagem exibina de não houver dados --}}
        <div class="flex items-center dark:text-white dark:divide-zinc-700">
            <dd class="md:text-sm text-center font-normal text-zinc-700 dark:text-zinc-100">
                Não existe prisões cadastrada para esse preso
            </dd>
        </div>
    @endforelse