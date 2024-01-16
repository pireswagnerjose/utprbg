<div>
    {{-- quando está sem imagem --}}
    @if (empty( $prisoner->photo))
    <span class="flex flex-col w-full items-center">
        <img class="object-cover h-full w-full rounded-lg" src='{{ asset("storage/site/no-image.jpg") }}' alt="sem foto">
    </span>
    <button wire:click="modalPrisonerProfilePhoto({{ $prisoner->id }})" class="font-medium text-xs text-blue-600 dark:text-blue-500 hover:underline">Cadastrar Foto</button>
    @endif

    {{-- quando está com imagem --}}
    @if (!empty( $prisoner->photo))
        <span class="flex flex-col w-full items-center">
            <img class="object-cover max-h-72 w-full rounded-lg" src='{{ asset("storage/$prisoner->photo") }}' alt="{{ $prisoner->name }}">
        </span>
        <button wire:click="modalPrisonerProfilePhoto({{ $prisoner->id }})" class="font-medium text-xs text-blue-600 dark:text-blue-500 hover:underline">Alterar Foto</button>
    @endif
</div>