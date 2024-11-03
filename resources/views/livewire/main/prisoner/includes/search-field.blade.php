{{-- Linha 1 --}}
<div class="grid grid-cols-4 gap-6 mt-6">
    <div class="relative col-span-2 z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="prisonerForm.name" />
        <x-label for="prisonerForm.name" value="{{ 'Nome do Preso' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="prisonerForm.nickname" />
        <x-label for="prisonerForm.nickname" value="{{ 'Alcunha' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="prisonerForm.cpf" />
        <x-label for="prisonerForm.cpf" value="{{ 'CPF' }}" />
    </div>
</div>
{{-- Linha 2 --}}
<div class="grid grid-cols-4 gap-6 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="prisonerForm.rg" />
        <x-label for="prisonerForm.rg" value="{{ 'RG' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="prisonerForm.title" />
        <x-label for="prisonerForm.title" value="{{ 'Título de Eleitor' }}" />
        <x-input-error for="title" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="prisonerForm.birth_certificate" />
        <x-label for="prisonerForm.birth_certificate" value="{{ 'Certidão de Nascimento' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="prisonerForm.sus_card" />
        <x-label for="prisonerForm.sus_card" value="{{ 'CARTÃO SUS' }}" />
    </div>
</div>
{{-- Linha 3 --}}
<div class="grid grid-cols-5 gap-6 mt-6">
    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="prisonerForm.status_prison_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'Status da Prisão' }}</option>
            @foreach ($prisonerForm->status_prisons as $status_prison)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $status_prison->id }}">{{ $status_prison->status_prison }}</option>
            @endforeach
        </select>
    </div>
    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="prisonerForm.civil_status_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'ESTADO CIVIL' }}</option>
            @foreach ($prisonerForm->civil_statuses as $civil_status)
            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $civil_status->id }}">{{ $civil_status->civil_status }}</option>
            @endforeach
        </select>
    </div>
    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="prisonerForm.ethnicity_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'ETNIA' }}</option>
            @foreach ($prisonerForm->ethnicities as $ethnicity)
            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $ethnicity->id }}">{{ $ethnicity->ethnicity }}</option>
            @endforeach
        </select>
    </div>
    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="prisonerForm.sexual_orientation_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'ORIENTAÇÃO SEXUAL' }}</option>
            @foreach ($prisonerForm->sexual_orientations as $sexual_orientation)
            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $sexual_orientation->id }}">{{ $sexual_orientation->sexual_orientation }}</option>
            @endforeach
        </select>
    </div>
    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="prisonerForm.country_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'NACIONALIDADE' }}</option>
            @foreach ($prisonerForm->countries as $country)
            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $country->id }}">{{ $country->country }}</option>
            @endforeach
        </select>
    </div>
</div>