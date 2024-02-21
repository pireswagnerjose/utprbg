{{-- Linha 1 --}}
<div class="grid grid-cols-4 gap-6 mt-6">
    <div class="relative col-span-2 z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="name" />
        <x-label for="name" value="{{ 'Nome do Preso' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="nickname" />
        <x-label for="nickname" value="{{ 'Alcunha' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="cpf" />
        <x-label for="cpf" value="{{ 'CPF' }}" />
    </div>
</div>
{{-- Linha 2 --}}
<div class="grid grid-cols-4 gap-6 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="rg" />
        <x-label for="rg" value="{{ 'RG' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="title" />
        <x-label for="title" value="{{ 'Título de Eleitor' }}" />
        <x-input-error for="title" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="birth_certificate" />
        <x-label for="birth_certificate" value="{{ 'Certidão de Nascimento' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="sus_card" />
        <x-label for="sus_card" value="{{ 'CARTÃO SUS' }}" />
    </div>
</div>
{{-- Linha 3 --}}
<div class="grid grid-cols-5 gap-6 mt-6">
    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="status_prison_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'Status da Prisão' }}</option>
            @foreach ($status_prisons as $status_prison)
            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $status_prison->id }}">{{ $status_prison->status_prison }}</option>
            @endforeach
        </select>
    </div>
    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="civil_status_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'ESTADO CIVIL' }}</option>
            @foreach ($civil_statuses as $civil_status)
            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $civil_status->id }}">{{ $civil_status->civil_status }}</option>
            @endforeach
        </select>
    </div>
    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="ethnicity_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'ETNIA' }}</option>
            @foreach ($ethnicities as $ethnicity)
            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $ethnicity->id }}">{{ $ethnicity->ethnicity }}</option>
            @endforeach
        </select>
    </div>
    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="sexual_orientation_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'ORIENTAÇÃO SEXUAL' }}</option>
            @foreach ($sexual_orientations as $sexual_orientation)
            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $sexual_orientation->id }}">{{ $sexual_orientation->sexual_orientation }}</option>
            @endforeach
        </select>
    </div>
    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="country_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'NACIONALIDADE' }}</option>
            @foreach ($countries as $country)
            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $country->id }}">{{ $country->country }}</option>
            @endforeach
        </select>
    </div>
</div>