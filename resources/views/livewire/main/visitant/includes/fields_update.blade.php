{{-- linha 1 --}}
<div class="grid grid-cols-6 gap-8 w-full">
    <div class="col-span-1">
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
            {{ 'Selecione a foto do visitante' }}
        </x-secondary-button>
        <x-input-error for="photo" class="mt-2" />

        <div class="w-full flex justify-center">
            @if ($photo)
                <img class="w-48 h-56 mt-6 rounded-md" src="{{ $photo->temporaryUrl() }}" alt="">
            @endif
        </div>
    </div>

    <div class="col-span-5">
        {{-- linha 2 --}}
        <div class="grid md:grid-cols-7 md:gap-8 mb-8 mt-12">
            <div class="col-span-3 relative z-0 w-full group">
                <x-input type="text" wire:model="name" id="name" />
                <x-label for="name" wire:model="name" value="{{ 'Nome' }}" />
                <x-input-error for="name" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-2 relative z-0 w-full group">
                <x-input type="text" wire:model="cpf" id="cpf" x-mask="999.999.999-99" />
                <x-label for="cpf" wire:model="cpf" value="{{ 'CPF' }}" />
                <x-input-error for="cpf" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-2 relative z-0 w-full group">
                <x-input type="text" wire:model="phone" id="phone" x-mask="(99) 99999-9999" />
                <x-label for="phone" wire:model="phone" value="{{ 'Fone' }}" />
                <x-input-error for="phone" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>

        {{-- linha 3 --}}
        <div class="grid md:grid-cols-4 mb-8 md:gap-6">
            <div class="col-span-3 relative z-0 w-full group">
                <x-input type="text" wire:model="address" id="address" />
                <x-label for="address" wire:model="address" value="{{ 'Endereço' }}" />
                <x-input-error for="address" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-1 relative z-0 w-full group">
                <select id="status" wire:model="status"
                    class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="">Status</option> 
                    <option class="text-zinc-900 dark:text-zinc-600" value="ATIVO">ATIVO</option>
                    <option class="text-zinc-900 dark:text-zinc-600" value="INATIVO">INATIVO</option> 
                </select>
                <x-input-error for="status" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

        </div>

        {{-- linha 4 --}}
        <div class="relative z-0 w-full group mb-6">
            <textarea id="remark" wire:model="remark" rows="6" class="
                    block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md
                    bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400
                    text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Informações Complementares">
                {{ old('remark', $visitant->remark ?? '') }}
            </textarea>
        </div>
    </div>
</div>