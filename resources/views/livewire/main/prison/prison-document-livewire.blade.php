<div>
    <button wire:click="modalPrisonDocument({{ $prison_id }})"><span class="text-blue-600 mr-4">[ Adicionar ]</span></button>
    <div class="">
        @if($prison->prison_documents)
            <div class="grid grid-cols-2 p-2 rounded-lg gap-20">
                @foreach ($prison->prison_documents as $prison_document)
                    <div class="border-b dark:border-zinc-700 flex justify-between">
                        <div class="text-sm uppercase font-medium">
                            <a title='{{ $prison_document->document }}' href='{{ asset("storage/$prison_document->document") }}' rel='shadowbox[galeria]'>
                                <dd class="font-semibold text-blue-700 dark:text-blue-500 hover:underline">{{ $prison_document->title }}</dd>
                            </a>
                        </div>
                        <div class="flex">
                            <button wire:click="modalPrisonDocumentEdit({{ $prison_document->id }})"><span class="text-green-600 text-xs mr-4">[ Editar ]</span></button>
                            <button wire:click="modalPrisonDocumentDelete({{ $prison_document->id }})"><span class="text-red-600 text-xs">[ excluir ]</span></button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    @include("livewire.main.prison.includes.document-modal-add")
    @include("livewire.main.prison.includes.document-modal-update")
    @include("livewire.main.prison.includes.document-modal-delete")
</div>
