<div class="col-span-6 sm:col-span-4">
    {{-- Título --}}
    <div class="relative z-0 w-full group mt-12">
        <select wire:model="position" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $this->position ?? '' }}">{{ $this->position ?? 'Posição da Foto' }}</option>
            @isset($positions)
                @foreach ($positions as $position_collection)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $position_collection ?? '' }}" @selected(old('position') ==  $position_collection)>{{ $position_collection }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="position" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{-- Descrição --}}
    <div class="relative z-0 w-full group mt-8">
        <x-input type="text" wire:model="description" />
        <x-label for="description" value="{{ 'Discirção da Foto' }}" />
        <x-input-error for="description" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{-- Miniatura da photo quando for ediçao --}}
    <div class="w-full flex justify-center">
        @if (!empty($this->photo_collection->photo))
            <img class="w-40 h-50 mt-6 rounded-md" src="{{ asset("storage/$photo_collection->photo") }}" />
        @endif
    </div>
    {{-- Photo --}}
    <div class="gril grid-cols-1 space-y-2 w-full justify-center mt-6 text-center">
        <label for="photo" class="text-sm uppercase text-zinc-500 dark:text-zinc-400">Selecione uma Imagem<span class="text-danger">*</span></label>
        <input type="file" wire:model="photo" wire:key="{{ $image_key }}" class="p-1 bg-gray-300 dark:bg-gray-700 rounded-lg w-3/4" />
        @error('photo')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    {{-- Miniatura da photo --}}
    <div class="w-full flex justify-center">
        @if ($this->photo && empty($this->photo_collection->photo))
            @if (in_array($photo->extension(), ['png', 'jpg', 'jpeg']))
                <img class="w-72 h-80 mt-6 rounded-md" src="{{ $photo->temporaryUrl() }}" />
            @endif
        @endif
    </div>
</div>
