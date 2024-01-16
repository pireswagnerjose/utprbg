{{-- linha 1 --}}
<div class="grid grid-cols-6 gap-4 mt-12">
    <div class="col-span-3 relative z-0 w-full group">
        <x-input type="text" id="lawyer" wire:model="lawyer" required />
        <x-label for="lawyer" wire:model="lawyer" value="{{ 'Nome do Advogado' }}" />
        <x-input-error for="lawyer" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" id="register" wire:model="register" required />
        <x-label for="register" wire:model="register" value="{{ 'Registro' }}" />
        <x-input-error for="register" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class=" col-span-2 relative z-0 w-full group">
        <x-input type="text" id="contact" wire:model="contact" required />
        <x-label for="contact" wire:model="contact" value="{{ 'Contato' }}" />
        <x-input-error for="contact" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>
{{-- linha2 --}}
<div class="relative z-0 w-full group mt-4">
    <label for="remark" class="block mb-2 uppercase text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
    <textarea type="text" id="remark" wire:model="remark" rows="3"
        class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Observações">{{ $remark }}</textarea>
</div>