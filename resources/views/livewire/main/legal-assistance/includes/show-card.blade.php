@forelse ($legal_assistances as $legal_assistance)
    <div class="mx-auto p-4 relative border-b border-blue-400 dark:border-blue-600">
        {{-- botões --}}
        <div class="flex z-10 absolute w-full space-x-8 items-center justify-end pr-6">
            <button wire:click="modalLegalAssistanceUpdate({{ $legal_assistance->id }})" class="text-sm text-teal-500 font-semibold rounded hover:text-teal-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
            </button>

            <button wire:click="modalLegalAssistanceDelete({{ $legal_assistance->id }})" wire:loading.attr="disabled" class="text-sm text-red-500 font-semibold rounded hover:text-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </button>
        </div>

        {{-- linha 1 --}}
        <div class="grid grid-cols-6 gap-4 mb-5">
            <div class="col-span-2">
                <x-item-topic>Tipo de Atendimento</x-item-topic>
                <x-item-data>{{ $legal_assistance->type_care->type_care }}</x-item-data>
            </div>
            <div class="col-span-2">
                <x-item-topic>Modalidade do Atendimento</x-item-topic>
                <x-item-data>{{ $legal_assistance->modality_care->modality_care }}</x-item-data>
            </div>
            <div class="col-span-1">
                <x-item-topic>Data</x-item-topic>
                @empty(!$legal_assistance->date)
                    <x-item-data>{{ \Carbon\Carbon::parse($legal_assistance->date)->format('d/m/Y') }}</x-item-data>
                @endempty
            </div>
            <div class="col-span-1">
                <x-item-topic>Hora</x-item-topic>
                <x-item-data>{{ $legal_assistance->time }}</x-item-data>
            </div>
        </div>
         {{-- linha 2 --}}
         <div class="grid grid-cols-8 gap-4 mb-5">
            <div class="col-span-1">
                <x-item-topic>Status</x-item-topic>
                @if ($legal_assistance->status == 'CANCELADO')
                    <div class="text-base font-semibold text-red-700 uppercase">{{ $legal_assistance->status }}</div>
                @else
                    <div class="text-base font-semibold text-green-700 uppercase">{{ $legal_assistance->status }}</div>
                @endif
            </div>
            <div class="col-span-3">
                <x-item-topic>Advogado</x-item-topic>
                @empty(!$legal_assistance->lawyer_id)
                    <x-item-data>{{ $legal_assistance->lawyer->lawyer }}</x-item-data>
                @endempty
            </div>
            <div class="col-span-2">
                <x-item-topic>Comarca da Audiência</x-item-topic>
                @empty(!$legal_assistance->district_id)
                    <x-item-data>{{ $legal_assistance->district->district }}</x-item-data>
                @endempty
            </div>
            <div class="col-span-2">
                <x-item-topic>Vara Criminal</x-item-topic>
                @empty(!$legal_assistance->criminal_court_id)
                    <x-item-data>{{ $legal_assistance->criminal_court->criminal_court }}</x-item-data>
                @endempty
            </div>
         </div>
        {{-- linha 3 --}}
        <div class="grid grid-cols-6 gap-4 mb-5 items-center">
            <div class="col-span-5">
                <x-item-topic>Observações</x-item-topic>
                <x-item-data class="text-justify">{{ $legal_assistance->remark }}</x-item-data>
            </div>
            @if ($legal_assistance->document != null)
                <div class="col-span-1 bg-zinc-200 dark:bg-zinc-600 hover:bg-zinc-300 dark:hover:bg-zinc-700 p-4 rounded-lg mx-auto">
                    <a class="realtive flex items-center" title='{{ $legal_assistance->document }}' href='{{ asset("storage/$legal_assistance->document") }}' rel='shadowbox[galeria]'>
                        <svg class="w-8 h-8 text-blue-700 dark:text-blue-500 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9v-5h1.5a1.5 1.5 0 1 1 0 3H1m12 2v-5h2m-2 3h2m-8-3v5h1.375A1.626 1.626 0 0 0 10 13.375v-1.75A1.626 1.626 0 0 0 8.375 10H7Z"/>
                        </svg>
                        <dd class="font-semibold text-blue-700 dark:text-blue-500">Documento</dd>
                        <img class="hidden" src='{{ asset("storage/$legal_assistance->document") }}' alt="Documento">
                    </a>
                </div>
            @endif
        </div>
    </div>
    @empty
        {{-- mensagem exibina de não houver dados --}}
        <div class="flex items-center dark:text-white dark:divide-gray-700">
            <dd class="md:text-sm text-center font-normal text-gray-700 dark:text-gray-100">
                Não existe atendimento jurídico cadastrado para esse preso
            </dd>
        </div>
@endforelse