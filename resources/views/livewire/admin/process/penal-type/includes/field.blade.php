<div class="grid grid-cols-4 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="law" wire:model="law" />
        <x-label for="law" wire:model="law" value="{{ 'Lei' }}" />
        <x-input-error for="law" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" id="article" wire:model="article" />
        <x-label for="article" wire:model="article" value="{{ 'Artigo' }}" />
        <x-input-error for="article" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" id="paragraph" wire:model="paragraph" />
        <x-label for="paragraph" wire:model="paragraph" value="{{ 'Parágrafo' }}" />
        <x-input-error for="paragraph" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" id="item" wire:model="item" />
        <x-label for="item" wire:model="item" value="{{ 'Parágrafo' }}" />
        <x-input-error for="item" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>
<div class="relative z-0 w-full group mt-6">
    <div class="relative z-0 w-full mb-6 group">
        <label for="description" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Descrição</label>
        <textarea id="description" wire:model='description' rows="6" class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Descrição sobre o tipo penal">{{ old('description', $description ?? '') }}</textarea>
    </div>
    <x-input-error for="item" class="mt-2">{{ $message ?? '' }}</x-input-error>
</div>