@forelse ($addresses as $address)
<div class="mx-auto p-4 relative border-b border-blue-400 dark:border-blue-600">
    {{-- botões --}}
    <div class="flex z-10 absolute w-full space-x-8 items-center justify-end pr-6">
        @can('update_address')
        <button wire:click="modalAddressUpdate({{ $address->id }})"
            class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
            <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
        </button>
        @endcan

        @can('delete_address')
        <button wire:click="modalAddressDelete({{ $address->id }})" wire:loading.attr="disabled"
            class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
            <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
        </button>
        @endcan
    </div>

    {{-- linha 1 --}}
    <div class="grid grid-cols-6 gap-4 mb-5">
        <div class="col-span-3">
            <x-item-topic>Logradouro</x-item-topic>
            <x-item-data>{{ $address->street }}</x-item-data>
        </div>
        <div>
            <x-item-topic>Número</x-item-topic>
            <x-item-data>{{ $address->number }}</x-item-data>
        </div>
        <div class="col-span-2">
            <x-item-topic>Complemento</x-item-topic>
            <x-item-data>{{ $address->complement }}</x-item-data>
        </div>
    </div>
    {{-- linha 2 --}}
    <div class="grid grid-cols-3 gap-4 mb-5">
        <div>
            <x-item-topic>Bairro</x-item-topic>
            <x-item-data>{{ $address->barrio }}</x-item-data>
        </div>
        <div>
            <x-item-topic>Cidade</x-item-topic>
            <x-item-data>{{ $address->municipality->municipality }}</x-item-data>
        </div>
        <div>
            <x-item-topic>Estado</x-item-topic>
            <x-item-data>{{ $address->state->state }}</x-item-data>
        </div>
    </div>
    {{-- linha 3 --}}
    <div class="mb-5">
        <div>
            <x-item-topic>Observações</x-item-topic>
            <x-item-data class="text-justify">{{ $address->remark }}</x-item-data>
        </div>
    </div>
</div>
@empty
{{-- mensagem exibina de não houver dados --}}
<div class="flex items-center dark:text-white dark:divide-gray-700">
    <dd class="md:text-sm text-center font-normal text-gray-700 dark:text-gray-100">
        Não existe prisões cadastrada para esse preso
    </dd>
</div>
@endforelse