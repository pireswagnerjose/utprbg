{{-- linha1 --}}
<div class="mt-16">
    {{-- Photo --}} 
    <div class="flex justify-center">
        <div class="mb-12 w1/3">
            <input type="file" id="photo" wire:model.live="restorative_justice_form.path" class="runded-md bg-zinc-300 dark:bg-zinc-600" />
            <x-input-error for="restorative_justice_form.path" class="mt-2" /> 
        </div>
    </div>
    {{-- linha 2 --}}
    <div class="mb-6 grid grid-cols-1 gap-6">
        <div class="col-span-3 relative z-0 w-full group">
            <x-input type="text" wire:model="restorative_justice_form.title" />
            <x-label for="restorative_justice_form.title" value="{{ 'Título do Documento' }}" />
            <x-input-error for="restorative_justice_form.title" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
    </div>
</div>
