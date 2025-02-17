@forelse ($internal_services as $internal_service)
<div class="mx-auto p-4 relative border-b border-blue-400 dark:border-blue-600">
  {{-- botões --}}
  <div class="flex z-10 absolute w-full space-x-8 items-center justify-end pr-6">
    @can('update_internal_service')
    <button wire:click="modalInternalServiceUpdate({{ $internal_service->id }})"
      class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
      <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
    </button>
    @endcan

    @can('delete_internal_service')
    <button wire:click="modalInternalServiceDelete({{ $internal_service->id }})" wire:loading.attr="disabled"
      class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
      <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
    </button>
    @endcan
  </div>

  {{-- linha 1 --}}
  <div class="grid grid-cols-5 gap-4 mb-5">
    <div class="col-span-2">
      <x-item-topic>Tipo do Atendimento</x-item-topic>
      <x-item-data>{{ $internal_service->type_service->type_service }}</x-item-data>
    </div>
    <div class="">
      <x-item-topic>Data</x-item-topic>
      @empty(!$internal_service->date)
      <x-item-data>{{ \Carbon\Carbon::parse($internal_service->date)->format('d/m/Y') }}</x-item-data>
      @endempty
    </div>
    <div class="">
      <x-item-topic>Hora</x-item-topic>
      <x-item-data>{{ $internal_service->time }}</x-item-data>
    </div>
    <div class="">
      <x-item-topic>Status</x-item-topic>
      @if ($internal_service->status == 'CANCELADO')
      <div class="text-base font-semibold text-red-700 uppercase">{{ $internal_service->status }}</div>
      @else
      <div class="text-base font-semibold text-green-700 uppercase">{{ $internal_service->status }}</div>
      @endif
    </div>
  </div>
  {{-- linha 4 --}}
  <div class="mb-5">
    <div class="">
      <x-item-topic>Observações</x-item-topic>
      <x-item-data class="text-justify">{{ $internal_service->remark }}</x-item-data>
    </div>
  </div>
</div>

@empty
{{-- mensagem exibina de não houver dados --}}
<div class="flex items-center dark:text-white dark:divide-gray-700">
  <dd class="md:text-sm text-center font-normal text-gray-700 dark:text-gray-100">
    Não existe atendimento interno cadastrado para esse preso
  </dd>
</div>
@endforelse
{{-- paginador --}}
<div class="">{{-- paginação --}}
  {{ $internal_services->onEachSide(1)->links() }}
</div>