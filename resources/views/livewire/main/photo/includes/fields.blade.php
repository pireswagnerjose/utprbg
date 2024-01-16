<div class="col-span-6 sm:col-span-4">
    {{-- Photo --}}
    <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].fisrt_name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />
    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
        {{ 'Selecione uma imagem' }}
    </x-secondary-button>
    <x-input-error for="photo" class="mt-2" />
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
    {{-- Miniatura da photo --}}
    <div class="w-full flex justify-center">
        @if ($photo)
            <img class="w-72 h-80 mt-6 rounded-md" src="{{ $photo->temporaryUrl() }}" alt="">
        @endif
    </div>
</div>