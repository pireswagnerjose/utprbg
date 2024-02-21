<form>
    <div class="col-span-6 sm:col-span-4">
        {{-- Photo --}}
        <div class="flex w-full justify-center">
            <input type="file" wire:model="photo_create_form.photo" wire:key="{{ $image_key }}" />
            <x-input-error for="photo_create_form.photo" class="mt-2" />
        </div>
        {{-- Título --}}
        <div class="relative z-0 w-full group mt-12">
            <select wire:model="photo_create_form.position" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $photo_create_form->position ?? '' }}">{{ $photo_create_form->position ?? 'Posição da Foto' }}</option>
                @isset($photo_create_form->positions)
                    @foreach ($photo_create_form->positions as $position_arr)
                        <option class="text-zinc-900 dark:text-zinc-600" value="{{ $position_arr ?? '' }}" @selected(old('position') ==  $position_arr)>{{ $position_arr }}</option>
                    @endforeach
                @endisset
            </select>
            <x-input-error for="photo_create_form.position" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
        {{-- Descrição --}}
        <div class="relative z-0 w-full group mt-8">
            <x-input type="text" wire:model="photo_create_form.description" />
            <x-label for="description" value="{{ 'Breve discirção do documento' }}" />
            <x-input-error for="photo_create_form.description" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
        {{-- Miniatura da photo --}}
        <div class="w-full flex justify-center">
            @if ($photo_create_form->photo)
                <img class="w-72 h-80 mt-6 rounded-md" src="{{ $photo_create_form->photo->temporaryUrl() }}" alt="">
            @endif
        </div>
    </div>
</form>