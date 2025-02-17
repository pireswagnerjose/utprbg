@can('create_restorative_justice')
<div>
  <button wire:click="modalRelatedDocumentCreate({{ $restorative_justice->id }})" type="button"
    class="p-1 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
    <x-lucide-plus class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
  </button>
  <span class="text-sm ml-2">Documentos Relacionados</span>
</div>
@endcan

<div>
  @forelse ($restorative_justice->restorative_justice_documents as $restorative_justice_document)
  <div class="grid grid-cols-2 px-2 rounded-lg gap-6">
    <div class="border-b dark:border-zinc-700 flex justify-between mx-6">
      <div class="text-sm uppercase font-medium">
        <a title='{{ $restorative_justice_document->title }}'
          href='{{ asset("storage/$restorative_justice_document->path") }}' rel='shadowbox[galeria]'>
          <dd class="font-semibold text-blue-700 dark:text-blue-500 hover:underline">{{
            $restorative_justice_document->title }}</dd>
        </a>
      </div>
      @can('delete_restorative_justice')
      <div class="flex">
        <button wire:click="modalRelatedDocumentDelete({{ $restorative_justice_document->id }})"><span
            class="text-red-600 text-xs">[ excluir ]</span></button>
      </div>
      @endcan
    </div>
  </div>
  @empty
  <p class="w-full flex justify-center text-red-500 text-sm">Não existe documento cadastrado</p>
  @endforelse
</div>