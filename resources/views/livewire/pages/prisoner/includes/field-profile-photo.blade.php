<div class="col-span-6 sm:col-span-4">
   {{-- Photo --}}
   <div class="gril grid-cols-1 space-y-2 w-full justify-center mt-6 text-center">
        <label for="photo" class="text-sm uppercase text-zinc-500 dark:text-zinc-400">Selecione uma Imagem<span class="text-danger">*</span></label>
        <input type="file" wire:model="photo" class="p-1 bg-zinc-300 dark:bg-zinc-700 rounded-lg w-3/4" />
        @error('photo')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full flex justify-center">
        @if ($photo)
            @if (in_array($photo->extension(), ['png', 'jpg', 'jpeg']))
                <img class="w-56 mt-6 rounded-md" src="{{ $photo->temporaryUrl() }}" alt="">
            @endif
        @endif
    </div>
</div>