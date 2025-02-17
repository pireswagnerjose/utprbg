<div class="mx-auto p-4 relative border-b border-blue-400 dark:border-blue-600">
  <div class="flex z-10 absolute w-full space-x-8 items-center justify-end pr-6">
    @can('update_videoconference_hearing')
    <button wire:click="modalUpdate({{ $videoconference_hearing->id }}, 'lawyer')"
      class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
      <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
    </button>
    @endcan

    @can('delete_videoconference_hearing')
    <button wire:click="modalDelete({{ $videoconference_hearing->id }})" wire:loading.attr="disabled"
      class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
      <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
    </button>
    @endcan
  </div>
  {{-- linha 1 --}}
  <div class="grid grid-cols-9 gap-4 mb-5">
    <div class="col-span-2">
      <x-item-topic>Comarca: </x-item-topic>
      <x-item-data>{{ $videoconference_hearing->district->district }}</x-item-data>
    </div>

    <div class="col-span-3">
      <x-item-topic>Vara Criminal: </x-item-topic>
      <x-item-data>{{ $videoconference_hearing->criminal_court->criminal_court }}</x-item-data>
    </div>

    <div class="col-span-1">
      <x-item-topic>Data </x-item-topic>
      <x-item-data>{{ \Carbon\Carbon::parse($videoconference_hearing->date_of_service)->format('d/m/Y' ) }}
      </x-item-data>
    </div>

    <div class="col-span-1">
      <x-item-topic>Hora </x-item-topic>
      <x-item-data>{{ $videoconference_hearing->time_of_service }}</x-item-data>
    </div>

    <div class="col-span-1">
      <x-item-topic>Status</x-item-topic>
      <x-item-data>{{ $videoconference_hearing->status }}</x-item-data>
    </div>
  </div>

  {{-- linha 2 --}}
  <div>
    <x-item-topic>Observações</x-item-topic>
    <x-item-data class="text-justify">{{ $videoconference_hearing->remark }}</x-item-data>
  </div>

  {{-- linha 4 --}}
  <div class="grid border-t mt-2 pt-2 border-zinc-300 dark:border-zinc-600">
    <div class="px-4">
      @include('livewire.main.legal-assistance.videoconference-hearing.includes.related-documents')
    </div>
  </div>
</div>