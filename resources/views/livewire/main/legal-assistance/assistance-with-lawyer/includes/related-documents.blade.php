<div>
   <button wire:click="modalRelatedDocumentCreate({{ $assistance_with_lawyer->id }})" type="button"
      class="mb-4 text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
   >
       <svg class="w-3 h-3 text-zinc-200 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
       </svg>
   </button>
   <span class="text-sm ml-2">Documentos Relacionados</span>
</div>
<div>
    @forelse ($assistance_with_lawyer->assistance_with_lawyer_documents as $assistance_with_lawyer_document)
        <div class="grid grid-cols-2 px-2 rounded-lg gap-6">
            <div class="border-b dark:border-zinc-700 flex justify-between mx-6">
                <div class="text-sm uppercase font-medium">
                    <a title='{{ $assistance_with_lawyer_document->title }}' href='{{ asset("storage/$assistance_with_lawyer_document->path") }}' rel='shadowbox[galeria]'>
                        <dd class="font-semibold text-blue-700 dark:text-blue-500 hover:underline">{{ $assistance_with_lawyer_document->title }}</dd>
                    </a>
                </div>
                @can('admin-cartorio_admin')
                    <div class="flex">
                        <button wire:click="modalRelatedDocumentDelete({{ $assistance_with_lawyer_document->id }})"><span class="text-red-600 text-xs">[ excluir ]</span></button>
                    </div>
                @endcan
            </div>
        </div>
    @empty
        <p class="w-full flex justify-center text-red-500 text-sm">Não existe documento cadastrado</p>
    @endforelse
</div>