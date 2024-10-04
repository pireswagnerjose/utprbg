<div class="">
    <div class="relative z-0 w-full group mt-8 flex items-center justify-center">
        <input type="file" id="document" wire:model.live="document" class="rounded-md" />
        <x-input-error for="document" class="mt-2" />
    </div>
    <div class="relative z-0 w-full group mt-12">
        <x-input type="text" wire:model="title" id="title_documet" />
        <x-label for="title" wire:model="title" value="{{ 'Título do Documento' }}" />
        <x-input-error for="title" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group mt-8" hidden>
        <x-input type="text" wire:model="description" id="description" />
        <x-label for="description" wire:model="description" value="{{ 'Breve discirção do documento' }}" />
        <x-input-error for="description" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group mt-8">
        <label for="remark" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
        <textarea id="remark" wire:model="remark" rows="6"
            class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Observações">{{ old('remark', $document->remark ?? '') }}</textarea>
    </div>
</div>