@forelse ($prisons as $prison)
<div class="mx-auto p-4 relative border-b border-blue-400 dark:border-blue-600">
  {{-- botões --}}
  <div class="flex z-10 absolute w-full space-x-8 items-center justify-end pr-6">
    @can('update_prison')
    <button wire:click="modalPrisonUpdate({{ $prison->id }})"
      class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
      <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
    </button>
    @endcan
    @can('delete_prison')
    <button wire:click="modalPrisonDelete({{ $prison->id }})" wire:loading.attr="disabled"
      class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
      <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
    </button>
    @endcan
  </div>

  {{-- linha 1 --}}
  <div class="grid grid-cols-5 gap-4 mb-5">
    <div class="col-span-2">
      <x-item-topic>Unidade Prisional</x-item-topic>
      <x-item-data>{{ $prison->prison_unit->prison_unit }}</x-item-data>
    </div>
    <div>
      <x-item-topic>Data de Entrada</x-item-topic>
      @empty(!$prison->entry_date)
      <x-item-data>{{ \Carbon\Carbon::parse($prison->entry_date)->format('d/m/Y') }}</x-item-data>
      @endempty
    </div>
    <div>
      <x-item-topic>Data de Saída</x-item-topic>
      @empty(!$prison->exit_date)
      <x-item-data>{{ \Carbon\Carbon::parse($prison->exit_date)->format('d/m/Y') }}</x-item-data>
      @endempty
    </div>
  </div>
  {{-- linha 2 --}}
  <div class="grid grid-cols-3 gap-4 mb-5">
    <div>
      <x-item-topic>Pena (em anos, meses e dias)</x-item-topic>
      <x-item-data>{{ $prison->sentence }}</x-item-data>
    </div>
    <div>
      <x-item-topic>Previsão de Saída</x-item-topic>
      @empty(!$prison->exit_forecast)
      <x-item-data>{{ \Carbon\Carbon::parse($prison->exit_forecast)->format('d/m/Y') }}</x-item-data>
      @endempty
    </div>
    <div>
      <x-item-topic>Data do Último Atestado de Pena</x-item-topic>
      @empty(!$prison->sentence_certificate)
      <x-item-data> {{ \Carbon\Carbon::parse($prison->sentence_certificate)->format('d/m/Y') }}</x-item-data>
      @endempty
    </div>
  </div>
  {{-- linha 3 --}}
  <div class="grid grid-cols-3 gap-4 mb-5">
    <div>
      <x-item-topic>Origem da Prisão</x-item-topic>
      <x-item-data>{{ $prison->prison_origin->prison_origin }}</x-item-data>
    </div>
    <div>
      <x-item-topic>Tipo da Prisão</x-item-topic>
      <x-item-data>{{ $prison->type_prison->type_prison }}</x-item-data>
    </div>
    <div>
      <x-item-topic>Tipo da Saída</x-item-topic>
      @empty(!$prison->output_type_id)
      <x-item-data>{{ $prison->output_type->output_type }}</x-item-data>
      @endempty
    </div>
  </div>

  {{-- linha 4 --}}
  <div class="grid mb-5">
    <x-item-topic>Documentos Relacionados</x-item-topic>
    <div class="px-4">
      @include('livewire.main.prison.prison-document-livewire')
    </div>
  </div>

  {{-- linha 5 --}}
  <div>
    <x-item-topic>Observações</x-item-topic>
    <x-item-data class="text-justify">{{ $prison->remarks }}</x-item-data>
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