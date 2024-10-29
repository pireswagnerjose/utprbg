<div class="container content py-6 mx-auto w-3/4">
    <div class="mx-auto">
        <div class="flex justify-center">
            <div class="mb-12 w1/3">
                {{-- Photo --}} 
                <input type="file" wire:model.live="lawyer_form.photo" class="runded-md bg-zinc-300 dark:bg-zinc-600" />
                <x-input-error for="photo" class="mt-2" /> 
                <x-input-error for="lawyer_form.photo" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>
        {{-- linha 2 --}}
        <div class="mb-6 grid grid-cols-6 gap-6">
            <div class="col-span-3 relative z-0 w-full group">
                <x-input type="text" wire:model="lawyer_form.lawyer" />
                <x-label for="lawyer_form.lawyer" value="{{ 'Nome do Advogado' }}" />
                <x-input-error for="lawyer_form.lawyer" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
            <div class="relative z-0 w-full group">
                <x-input type="text" wire:model="lawyer_form.register" />
                <x-label for="lawyer_form.register" value="{{ 'Registro' }}" />
                <x-input-error for="lawyer_form.register" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
            <div class="col-span-2 relative z-0 w-full group">
                <x-input type="text" wire:model="lawyer_form.contact" x-mask="(99) 99999-9999" />
                <x-label for="lawyer_form.contact" value="{{ 'Contato' }}" />
                <x-input-error for="lawyer_form.contact" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>
        {{-- linha3 --}}
        <div class="relative z-0 w-full group">
            <label for="remark" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
            <textarea wire:model="lawyer_form.remark" rows="3"
                class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Observações">{{ old('remark', $address->remark ?? '') }}</textarea>
        </div>
    </div>
</div>