<div>
    {{-- quando está sem imagem --}}
    @if (empty( $prisoner_show->photo))
        <span class="flex flex-col items-center">
            <img class="object-cover w-full rounded-lg" src='{{ asset("storage/site/no-image.jpg") }}' alt="sem foto">
        </span>
        @can('admin-cartorio_admin')
            <button wire:click="modalProfilePhoto({{ $prisoner_show->id }})" class="w-full font-medium text-xs text-center text-blue-600 dark:text-blue-500 hover:underline">Cadastrar Foto</button>
        @endcan
    @endif

    {{-- quando está com imagem --}}
    @if (!empty( $prisoner_show->photo))
        <span class="flex flex-col items-center">
            <img class="object-cover w-full rounded-lg" src='{{ asset("storage/$prisoner_show->photo") }}' alt="{{ $prisoner_show->name }}">
        </span>
        @can('admin-cartorio_admin')
            <button wire:click="modalProfilePhoto({{ $prisoner_show->id }})" class="w-full font-medium text-xs text-center text-blue-600 dark:text-blue-500 hover:underline">Alterar Foto</button>
        @endcan
        
    @endif
</div>