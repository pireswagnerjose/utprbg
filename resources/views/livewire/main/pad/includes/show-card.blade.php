@forelse ($pads as $pad)
    <div class="mx-auto p-4 relative border-b border-blue-400 dark:border-blue-600">
        {{-- botões --}}
        <div class="flex z-10 absolute w-full space-x-8 items-center justify-end pr-6">
            <button wire:click="modalPadUpdate({{ $pad->id }})" class="text-sm text-teal-500 font-semibold rounded hover:text-teal-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
            </button>

            <button wire:click="modalPadDelete({{ $pad->id }})" wire:loading.attr="disabled" class="text-sm text-red-500 font-semibold rounded hover:text-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </button>
        </div>

        {{-- linha 1 --}}
        <div class="grid grid-cols-6 gap-4 mb-5 pr-10">
            <div class="col-span-2">
                <x-item-topic>Tipo da Ocorrência</x-item-topic>
                <x-item-data>{{ $pad->pad_type_of_occurrence->pad_type_of_occurrence }}</x-item-data>
            </div>
            <div class="col-span-1">
                <x-item-topic>Número da Ocorrência</x-item-topic>
                <x-item-data>{{ $pad->register_number }}</x-item-data>
            </div>
            <div class="col-span-1">
                <x-item-topic>Data da Abertura</x-item-topic>
                <x-item-data>{{ \Carbon\Carbon::parse($pad->opening_date)->format('d/m/Y') }}</x-item-data>
            </div>
            <div class="col-span-1">
                <x-item-topic>Hora da Ocorrência</x-item-topic>
                <x-item-data>{{ $pad->opening_time }}</x-item-data>
            </div>
            <div class="col-span-1">
                <x-item-topic>Data da Conclusão</x-item-topic>
                @empty(!$pad->completion_date)
                    <x-item-data>{{ \Carbon\Carbon::parse($pad->completion_date)->format('d/m/Y') }}</x-item-data>
                @endempty
            </div>
        </div>

        {{-- linha 2 --}}
        <div class="grid grid-cols-4 gap-4 mb-5">
            <div class="col-span-1">
                <x-item-topic>Tipo da Ocorrência</x-item-topic>
                <x-item-data>{{ $pad->pad_nature_of_event->pad_nature_of_event }}</x-item-data>
            </div>
            <div class="col-span-1">
                <x-item-topic>Status</x-item-topic>
                <x-item-data>{{ $pad->pad_status->pad_status }}</x-item-data>
            </div>
            <div class="col-span-1">
                <x-item-topic>Local da Ocorrência</x-item-topic>
                <x-item-data>{{ $pad->pad_local->pad_local }}</x-item-data>
            </div>
            <div class="col-span-1">
                <x-item-topic>Tipo de Evento</x-item-topic>
                <x-item-data>{{ $pad->pad_event_type->pad_event_type }}</x-item-data>
            </div>
        </div>

        {{-- linha 3 --}}
        <div class="grid mb-5">
            <x-item-topic> Documentos Relacionados </x-item-topic>
            <div class="px-4">
                <button wire:click="modalPadDocumentCreate({{ $pad->id }})"><span class="text-blue-600 mr-4">[ Adicionar ]</span></button>
                <div class="">
                    @if($pad->pad_documents)
                        <div class="grid grid-cols-2 p-2 rounded-lg gap-20">
                            @foreach ($pad->pad_documents as $pad_document)
                                <div class="border-b dark:border-zinc-700 flex justify-between">
                                    <div class="text-sm uppercase font-medium">
                                        <a title='{{ $pad_document->document }}' href='{{ asset("storage/$pad_document->document") }}' rel='shadowbox[galeria]'>
                                            <dd class="font-semibold text-blue-700 dark:text-blue-500 hover:underline">{{ $pad_document->title }}</dd>
                                        </a>
                                    </div>
                                    <div class="flex">
                                        <button wire:click="modalPadDocumentUpdate({{ $pad_document->id }})"><span class="text-green-600 text-xs mr-4">[ Editar ]</span></button>
                                        <button wire:click="modalPadDocumentDelete({{ $pad_document->id }})"><span class="text-red-600 text-xs">[ excluir ]</span></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                @include("livewire.main.pad.includes.document-modal-create")
                @include("livewire.main.pad.includes.document-modal-update")
                @include("livewire.main.pad.includes.document-modal-delete")
            </div>
        </div>
         
        {{-- linha 4 --}}
        <div class="w-full">
            <x-item-topic>Observações</x-item-topic>
            <x-item-data class="text-justify">{{ $pad->remark }}</x-item-data>
        </div>
    </div>
    @empty
        {{-- mensagem exibina de não houver dados --}}
        <div class="flex items-center dark:text-white dark:divide-gray-700">
            <dd class="md:text-sm text-center font-normal text-gray-700 dark:text-gray-100">
                Não existe Pad cadastrado para esse preso
            </dd>
        </div>
@endforelse