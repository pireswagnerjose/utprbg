@forelse ($processes as $process)
<div class="mx-auto p-4 relative border-b border-blue-400 dark:border-blue-600">
  {{-- botões --}}
  <div class="flex z-10 absolute w-full space-x-8 items-center justify-end pr-6">
    @can('update_process')
    <button wire:click="modalProcessUpdate({{ $process->id }})"
      class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
      <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
    </button>
    @endcan

    @can('delete_process')
    <button wire:click="modalProcessDelete({{ $process->id }})" wire:loading.attr="disabled"
      class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
      <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
    </button>
    @endcan
  </div>

  {{-- linha 1 --}}
  <div class="grid grid-cols-3 gap-4 mb-5">
    <div>
      <x-item-topic>Data da Prisão no Processo</x-item-topic>
      @empty(!$process->date_arrest)
      <x-item-data>{{ \Carbon\Carbon::parse($process->date_arrest)->format('d/m/Y') }}</x-item-data>
      @endempty
    </div>
    <div>
      <x-item-topic>Data do Alvará no Processo</x-item-topic>
      @empty(!$process->date_exit)
      <x-item-data>{{ \Carbon\Carbon::parse($process->date_exit)->format('d/m/Y') }}</x-item-data>
      @endempty
    </div>
    <div>
      <x-item-topic>Origem do Processo</x-item-topic>
      <x-item-data>{{ $process->origin_process->origin_process }}</x-item-data>
    </div>
  </div>
  {{-- linha 2 --}}
  <div class="grid grid-cols-3 gap-4 mb-5">
    <div>
      <x-item-topic>Comarca de Origem</x-item-topic>
      <x-item-data>{{ $process->judicial_district_origin }}</x-item-data>
    </div>
    <div>
      <x-item-topic>Regime da Prisão</x-item-topic>
      <x-item-data>{{ $process->process_regime->process_regime }}</x-item-data>
    </div>
    <div>
      <x-item-topic>Número do EPROC</x-item-topic>
      <x-item-data>{{ $process->eproc }}</x-item-data>
    </div>
  </div>
  {{-- linha 3 --}}
  <div class="grid grid-cols-3 gap-4 mb-5">
    <div>
      <x-item-topic>Número do SEEU</x-item-topic>
      <x-item-data>{{ $process->seeu }}</x-item-data>
    </div>
    <div>
      <x-item-topic>Número do PJE</x-item-topic>
      <x-item-data>{{ $process->pje }}</x-item-data>
    </div>
    <div>
      <x-item-topic>Número do APF</x-item-topic>
      <x-item-data>{{ $process->apf }}</x-item-data>
    </div>
  </div>
  {{-- linha 4 --}}
  <div class="grid mb-5">
    <x-item-topic> Tipificação </x-item-topic>
    <div class="px-4">
      <livewire:main.process.process-penal-type-livewire :process_id="$process->id" :$prisoner_id />
    </div>
  </div>
  {{-- linha 5 --}}
  <div class="grid mb-5">
    <x-item-topic> Documentos Relacionados </x-item-topic>
    <div class="px-4">
      <livewire:main.process.process-document-livewire :process_id="$process->id" :$prisoner_id />
    </div>
  </div>
  {{-- linha 6 --}}
  <div class="mb-5">
    <div>
      <x-item-topic>Observações</x-item-topic>
      <x-item-data class="text-justify">{{ $process->remark }}</x-item-data>
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