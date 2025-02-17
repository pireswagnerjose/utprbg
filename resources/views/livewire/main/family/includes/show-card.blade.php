@forelse ($families as $family)
<div class="mx-auto p-4 relative border-b border-blue-400 dark:border-blue-600">
  {{-- botões --}}
  <div class="flex z-10 absolute w-full space-x-8 items-center justify-end pr-6">
    @can('update_family')
    <button wire:click="modalFamilyUpdate({{ $family->id }})"
      class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
      <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
    </button>
    @endcan

    @can('delete_family')
    <button wire:click="modalFamilyDelete({{ $family->id }})" wire:loading.attr="disabled"
      class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
      <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
    </button>
    @endcan
  </div>

  {{-- linha 1 --}}
  <div class="grid grid-cols-6 gap-4 mb-5">
    <div class="col-span-3">
      <x-item-topic>Nome</x-item-topic>
      <x-item-data>{{ $family->name }}</x-item-data>
    </div>
    <div class="col-span-1">
      <x-item-topic>Grau de Parentesco</x-item-topic>
      <x-item-data>{{ $family->degree_of_kinship->degree_of_kinship }}</x-item-data>
    </div>
    <div class="col-span-1">
      <x-item-topic>Contato</x-item-topic>
      <x-item-data>{{ $family->contact }}</x-item-data>
    </div>
  </div>

  {{-- linha 3 --}}
  <div class="grid grid-cols-6 gap-4 mb-5 items-center">
    <div class="col-span-5">
      <x-item-topic>Observações</x-item-topic>
      <x-item-data class="text-justify">{{ $family->remark }}</x-item-data>
    </div>
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