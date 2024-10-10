<div class="col-span-6 sm:col-span-4">
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

    <div class="w-full flex justify-center">
        @if ($photo)
            @if (in_array($photo->extension(), ['png', 'jpg', 'jpeg']))
                <img class="w-72 h-80 mt-6 rounded-md" src="{{ $photo->temporaryUrl() }}" alt="">
            @endif
        @endif
    </div>
</div>