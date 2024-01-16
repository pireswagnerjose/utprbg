<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
    @if ($photos)
        @forelse ($photos as $photo)
            <div class="text-center">
                {{-- botões de edição e exclusão --}}
                <div class="flex">
                    <button wire:click="modalPhotoUpdate({{ $photo->id }})"><span class="text-blue-700 hover:text-blue-500 text-xs mr-4">[ Editar ]</span></button>
                    <button wire:click="modalPhotoDelete({{ $photo->id }})"><span class="text-red-700 hover:text-red-500 text-xs">[ excluir ]</span></button>
                </div>

                <a title='{{ $photo->description }}' href='{{ asset("storage/$photo->photo") }}' rel='shadowbox[galeria]'>
                    <img class="h-52 w-full rounded-lg" src='{{ asset("storage/$photo->photo") }}' alt="{{ $photo->descriprion }}">
                </a>
                <div class="font-light pt-2 text-xs text-zinc-500">{{ $photo->position }}</div>
                <div class="font-medium text-sm uppercase">{{ $photo->description }}</div>
            </div>
            @empty
                {{-- mensagem exibina de não houver dados --}}
                <div class="flex items-center dark:text-white dark:divide-gray-700">
                    <dd class="md:text-sm text-center font-normal text-gray-700 dark:text-gray-100">
                        Não existe foto cadastrada para esse preso
                    </dd>
                </div>
        @endforelse
    @endif
</div>