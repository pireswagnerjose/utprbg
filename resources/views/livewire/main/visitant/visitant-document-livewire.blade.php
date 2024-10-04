<div>
    @can('admin-cartorio_admin')
        <button wire:click="modalVisitantDocumentCreate({{ $visitant_id }})"><span class="text-blue-600">[ Adicionar ]</span></button>
    @endcan
        
    <div class="pt-4">
        <div class="grid grid-cols-2 p-2 rounded-lg gap-6">
            @foreach ($visitant_documents as $visitant_document)
                <div class="border-b dark:border-zinc-700 justify-between mx-6">
                    <div class="text-sm uppercase font-medium">
                        <a title='{{ $visitant_document->title }}' href='{{ asset("storage/$visitant_document->document") }}' rel='shadowbox[galeria]'>
                            <dd class="font-semibold text-blue-700 dark:text-blue-500 hover:underline">{{ $visitant_document->title }}</dd>
                        </a>
                        <div class="text-xs uppercase">
                            <dd class=" text-zinc-600 dark:text-zinc-400">{{ $visitant_document->remark }}</dd>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button wire:click="modalVisitantDocumentEdit({{ $visitant_document->id }})"><span class="text-green-600 text-xs mr-4">[ Editar ]</span></button>
                        <button wire:click="modalVisitantDocumentDelete({{ $visitant_document->id }})"><span class="text-red-600 text-xs">[ excluir ]</span></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include("livewire.main.visitant.includes.document-modal-create")
    @include("livewire.main.visitant.includes.document-modal-update")
    @include("livewire.main.visitant.includes.document-modal-delete")
</div>
