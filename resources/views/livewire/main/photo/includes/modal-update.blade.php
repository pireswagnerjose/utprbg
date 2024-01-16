<!-- update-->
<x-dialog-modal wire:model="openModalPhotoUpdate" maxWidth="xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados da Prisão' }}
    </x-slot>

    <x-slot name="content">
        {{-- Título --}}
        <div class="relative z-0 w-full group mt-12">
            <select id="position" wire:model="position" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $position ?? '' }}">{{ $position ?? 'Posição da Foto' }}</option>
                @isset($positions)
                    @foreach ($positions as $position_arr)
                        <option class="text-zinc-900 dark:text-zinc-600" value="{{ $position_arr ?? '' }}" @selected(old('position') ==  $position_arr)>{{ $position_arr }}</option>
                    @endforeach
                @endisset
            </select>
            <x-input-error for="position" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
        {{-- Descrição --}}
        <div class="relative z-0 w-full group mt-8">
            <x-input type="text" wire:model="description" id="description" />
            <x-label for="description" wire:model="description" value="{{ 'Breve discirção do documento' }}" />
            <x-input-error for="description" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="photoUpdate({{ $openModalPhotoUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
