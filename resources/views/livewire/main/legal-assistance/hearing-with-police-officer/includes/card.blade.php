<div class="mx-auto border-b border-blue-400 dark:border-blue-600">
    <div class="flex z-10 w-full justify-between my-2">
        @php
            $user_create = App\Models\User::where('id', $hearing_with_police_officer->user_create)->first();
            $user_update = App\Models\User::where('id', $hearing_with_police_officer->user_update)->first();
        @endphp

        <div class="flex gap-8 w-[70%]">
            <div class="flex text-xs">
                @if (!empty($user_create))
                    <p class=" text-zinc-400 dark:text-zinc-600">Cadastrado por: </p>
                    <p class="text-zinc-800 dark:text-zinc-200 italic">{{ $user_create->first_name }}
                        {{ $user_create->last_name }}</p>
                @endif
            </div>
            <div class="flex text-xs">
                @if (!empty($user_update))
                    <p class=" text-zinc-400 dark:text-zinc-600">Editador por: </p>
                    <p class="text-zinc-800 dark:text-zinc-200 italic">{{ $user_update->first_name }}
                        {{ $user_update->last_name }}</p>
                @endif
            </div>
        </div>

        <!-- botões -->
        <div class="flex items-center justify-end w-[30%] gap-2 sm:gap-4">
            @can('update_hearing_with_police_officer')
                <button wire:click="modalUpdate({{ $hearing_with_police_officer->id }}, 'lawyer')"
                    class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
                    <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
                </button>
            @endcan

            @can('delete_hearing_with_police_officer')
                <button wire:click="modalDelete({{ $hearing_with_police_officer->id }})" wire:loading.attr="disabled"
                    class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
                    <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
                </button>
            @endcan
        </div>
    </div>

    {{-- linha 1 --}}
    <div class="grid grid-cols-10 gap-4 mb-5">
        <div class="col-span-2">
            <x-item-topic>Delegado: </x-item-topic>
            <x-item-data>{{ $hearing_with_police_officer->delegate }}</x-item-data>
        </div>

        <div class="col-span-2">
            <x-item-topic>Delegacia: </x-item-topic>
            <x-item-data>{{ $hearing_with_police_officer->police_station }}</x-item-data>
        </div>

        <div class="col-span-1">
            <x-item-topic>Data </x-item-topic>
            <x-item-data>{{ \Carbon\Carbon::parse($hearing_with_police_officer->date_of_service)->format('d/m/Y') }}
            </x-item-data>
        </div>

        <div class="col-span-1">
            <x-item-topic>Hora </x-item-topic>
            <x-item-data>{{ $hearing_with_police_officer->time_of_service }}</x-item-data>
        </div>

        <div class="col-span-1">
            <x-item-topic>Status</x-item-topic>
            <x-item-data>{{ $hearing_with_police_officer->status }}</x-item-data>
        </div>

        <div class="col-span-2">
            <x-item-topic>Tipo do Atendimento</x-item-topic>
            <x-item-data>{{ $hearing_with_police_officer->modality_care->modality_care }}</x-item-data>
        </div>
    </div>

    {{-- linha 2 --}}
    <div>
        <x-item-topic>Observações</x-item-topic>
        <x-item-data class="text-justify">{{ $hearing_with_police_officer->remark }}</x-item-data>
    </div>

    {{-- linha 3 --}}
    <div class="grid border-t mt-2 pt-2 border-zinc-300 dark:border-zinc-600">
        <div class="px-4">
            @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.related-documents')
        </div>
    </div>
</div>
