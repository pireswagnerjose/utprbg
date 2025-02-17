<div class="grid grid-cols-3 gap-8 border-b border-blue-400 dark:border-blue-600">
  @forelse ($documents as $document)
  <div class="p-4 flex space-x-8 shadow-lg justify-between mb-4 bg-zinc-200 dark:bg-zinc-700 rounded-md">

    {{-- linha 1 --}}
    <div class="flex w-5/6">
      <a title='{{ $document->document }}' href='{{ asset("storage/$document->document") }}' rel='shadowbox[galeria]'>
        <div>
          <dd class="text-base font-medium uppercase text-blue-700">{{ $document->name }}</dd>
          <dd class="text-xs italic uppercase">{{ $document->description }}</dd>
          <img class="hidden" src='{{ asset("storage/$document->document") }}' alt="Documento">
        </div>
      </a>
    </div>

    {{-- botões --}}
    <div class="flex space-x-4 justify-end w-1/6">
      @can('update_document')
      <button wire:click="modalDocumentUpdate({{ $document->id }})"
        class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
      </button>
      @endcan

      @can('delete_document')
      <button wire:click="modalDocumentDelete({{ $document->id }})" wire:loading.attr="disabled"
        class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
      </button>
      @endcan

    </div>
  </div>

  @empty
  {{-- mensagem exibina de não houver dados --}}
  <div class="flex items-center dark:text-white dark:divide-gray-700">
    <dd class="md:text-sm text-center font-normal text-gray-700 dark:text-gray-100">
      Não existe saídas externas cadastrada para esse preso
    </dd>
  </div>
  @endforelse
</div>