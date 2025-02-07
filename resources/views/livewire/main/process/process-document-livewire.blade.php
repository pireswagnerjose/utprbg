<div>
  @can('create_document_process')
  <button wire:click="modalProcessDocument({{ $process_id }})"><span class="text-blue-600">[ Adicionar
      ]</span></button>
  @endcan

  <div class="pt-4">
    <div class="grid grid-cols-2 p-2 rounded-lg gap-6">
      @foreach ($process_documents as $process_document)
      <div class="border-b dark:border-zinc-700 flex justify-between mx-6">
        <div class="text-sm uppercase font-medium">
          <a title='{{ $process_document->title }}' href='{{ asset("storage/$process_document->document") }}'
            rel='shadowbox[galeria]'>
            <dd class="font-semibold text-blue-700 dark:text-blue-500 hover:underline">{{
              $process_document->title }}</dd>
          </a>
        </div>
        <div class="flex">
          @can('update_document_process')
          <button wire:click="modalProcessDocumentEdit({{ $process_document->id }})"><span
              class="text-green-600 text-xs mr-4">[ Editar ]</span>
          </button>
          @endcan
          @can('delete_document_process')
          <button wire:click="modalProcessDocumentDelete({{ $process_document->id }})"><span
              class="text-red-600 text-xs">[ excluir ]</span>
          </button>
          @endcan
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @include("livewire.main.process.includes.document-modal-create")
  @include("livewire.main.process.includes.document-modal-update")
  @include("livewire.main.process.includes.document-modal-delete")
</div>