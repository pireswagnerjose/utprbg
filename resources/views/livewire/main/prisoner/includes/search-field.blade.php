{{-- Linha 1 --}}
<div class="grid grid-cols-4 gap-6 mt-6">
    <div class="relative col-span-2 z-0 w-full group">
        <x-input type="text" id="name" wire:model.live.debounce.500ms="name" />
        <x-label for="name" wire:model="name" value="{{ 'Nome do Preso' }}" />
        <x-input-error for="name" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" id="nickname" wire:model.live.debounce.500ms="nickname" />
        <x-label for="nickname" wire:model="nickname" value="{{ 'Alcunha' }}" />
        <x-input-error for="nickname" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" id="cpf" wire:model.live.debounce.500ms="cpf" />
        <x-label for="cpf" wire:model="cpf" value="{{ 'CPF' }}" />
        <x-input-error for="cpf" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>
{{-- Linha 2 --}}
<div class="grid grid-cols-4 gap-6 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="rg" wire:model.live.debounce.500ms="rg" />
        <x-label for="rg" wire:model="rg" value="{{ 'RG' }}" />
        <x-input-error for="rg" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" id="title" wire:model.live.debounce.500ms="title" />
        <x-label for="title" wire:model="title" value="{{ 'Título de Eleitor' }}" />
        <x-input-error for="title" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" id="birth_certificate" wire:model.live.debounce.500ms="birth_certificate" />
        <x-label for="birth_certificate" wire:model="birth_certificate" value="{{ 'Certidão de Nascimento' }}" />
        <x-input-error for="birth_certificate" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" id="rji" wire:model.live.debounce.500ms="rji" />
        <x-label for="rji" wire:model="rji" value="{{ 'RJI' }}" />
        <x-input-error for="rji" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>