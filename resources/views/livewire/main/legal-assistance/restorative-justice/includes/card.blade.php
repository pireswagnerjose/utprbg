<div class="mx-auto p-4 relative border-b border-blue-400 dark:border-blue-600">
    <div class="flex z-10 absolute w-full space-x-8 items-center justify-end pr-6">
        <button wire:click="modalUpdate({{ $restorative_justice->id }}, 'lawyer')" class="text-sm text-teal-500 font-semibold rounded hover:text-teal-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
        </button>
        
        <button wire:click="modalDelete({{ $restorative_justice->id }})" wire:loading.attr="disabled" class="text-sm text-red-500 font-semibold rounded hover:text-red-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
        </button>
    </div>
    {{-- linha 1 --}}
    <div class="grid grid-cols-9 gap-4 mb-5">
        <div class="col-span-3">
            <x-item-topic>Facilitador: </x-item-topic>
            <x-item-data>{{ $restorative_justice->facilitator_conciliator }}</x-item-data>
        </div>

        <div class="col-span-1">
            <x-item-topic>Data </x-item-topic>
            <x-item-data>{{ \Carbon\Carbon::parse($restorative_justice->date_of_service)->format('d/m/Y' ) }}</x-item-data>
        </div>

        <div class="col-span-1">
            <x-item-topic>Hora </x-item-topic>
            <x-item-data>{{ $restorative_justice->time_of_service }}</x-item-data>
        </div>
        
        <div class="col-span-1">
            <x-item-topic>Status</x-item-topic>
            <x-item-data>{{ $restorative_justice->status }}</x-item-data>
        </div>

        <div class="col-span-2">
            <x-item-topic>Tipo do Atendimento</x-item-topic>
            <x-item-data>{{ $restorative_justice->modality_care->modality_care }}</x-item-data>
        </div>
    </div>
    
    {{-- linha 2 --}}
    <div>
        <x-item-topic>Observações</x-item-topic>
        <x-item-data class="text-justify">{{ $restorative_justice->remark }}</x-item-data>
    </div>

    {{-- linha 3 --}}
    <div class="grid border-t mt-2 pt-2 border-zinc-300 dark:border-zinc-600">
        <div class="px-4">
            @include('livewire.main.legal-assistance.restorative-justice.includes.related-documents')
        </div>
    </div>
</div>