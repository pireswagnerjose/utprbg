<div>
    @can('admin-cartorio_admin')
        <button wire:click="modalPrisonDocument({{ $prison->id }})"><span class="text-blue-600 mr-4">[ Adicionar ]</span></button>
    @endcan
    <div class="pt-4">
        @if($prison->prison_documents)
            <div class="grid grid-cols-2 px-2 rounded-lg gap-6">
                @foreach ($prison->prison_documents as $prison_document)
                    <div class="border-b dark:border-zinc-700 flex justify-between mx-6">
                        <div class="text-sm uppercase font-medium">
                            <a title='{{ $prison_document->title }}' href='{{ asset("storage/$prison_document->document") }}' rel='shadowbox[galeria]'>
                                <dd class="font-semibold text-blue-700 dark:text-blue-500 hover:underline">{{ $prison_document->title }}</dd>
                            </a>
                        </div>
                        @can('admin-cartorio_admin')
                            <div class="flex">
                                <button wire:click="modalPrisonDocumentEdit({{ $prison_document->id }})"><span class="text-green-600 text-xs mr-4">[ Editar ]</span></button>
                                <button wire:click="modalPrisonDocumentDelete({{ $prison_document->id }})"><span class="text-red-600 text-xs">[ excluir ]</span></button>
                            </div>
                        @endcan
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
