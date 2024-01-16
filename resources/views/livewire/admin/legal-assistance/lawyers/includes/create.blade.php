<div class="container content py-6 mx-auto w-3/4">
    <div class="mx-auto">
        <form wire:submit="lawyerCreate">
            <div class="flex">
                <div class="mb-6">
                    {{-- Photo --}}
                    <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change=" photoName = $refs.photo.files[0].fisrt_name;
                            const reader = new FileReader(); reader.onload = (e) => { photoPreview = e.target.result;};
                            reader.readAsDataURL($refs.photo.files[0]); " />
                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ 'Selecione uma imagem' }}
                    </x-secondary-button>
                    <x-input-error for="photo" class="mt-2" />
                </div>
                {{-- Miniatura da photo --}}
                <div class="-mt-40 ml-10">
                    @if ($photo)
                        <img class="w-72 h-44 mt-6 rounded-md" src="{{ $photo->temporaryUrl() }}" alt="">
                    @endif
                </div>
            </div>
            {{-- linha 2 --}}
            <div class="mb-6 grid grid-cols-6 gap-6">
                <div class="col-span-3 relative z-0 w-full group">
                    <x-input type="text" id="lawyer" wire:model="lawyer" required />
                    <x-label for="lawyer" wire:model="lawyer" value="{{ 'Nome do Advogado' }}" />
                    <x-input-error for="lawyer" class="mt-2">{{ $message ?? '' }}</x-input-error>
                </div>
                <div class="relative z-0 w-full group">
                    <x-input type="text" id="register" wire:model="register" required />
                    <x-label for="register" wire:model="register" value="{{ 'Registro' }}" />
                    <x-input-error for="register" class="mt-2">{{ $message ?? '' }}</x-input-error>
                </div>
                <div class="col-span-2 relative z-0 w-full group">
                    <x-input type="text" id="contact" wire:model="contact" required />
                    <x-label for="contact" wire:model="contact" value="{{ 'Contato' }}" />
                    <x-input-error for="contact" class="mt-2">{{ $message ?? '' }}</x-input-error>
                </div>
            </div>
            {{-- linha3 --}}
            <div class="relative z-0 w-full group">
                <label for="remark" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
                <textarea id="remark" wire:model="remark" rows="3"
                    class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Observações">{{ old('remark', $address->remark ?? '') }}</textarea>
            </div>
            <div class="flex justify-end mt-6">
                <x-button> {{ 'Adicionar' }} </x-button>
                <x-danger-button class="ms-3" wire:click.prevent="cancel">{{ 'Cancelar' }}</x-danger-button>
            </div>
            @if (session('success'))
                <span class="text-green-500 text-sm">{{ session('success') }}</span>
            @endif
        </form>
    </div>
</div>