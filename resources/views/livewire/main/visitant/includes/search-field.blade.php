{{-- Linha 1 --}}
<div class="grid grid-cols-4 gap-6 mt-6">
    <div class="relative col-span-2 z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="name" />
        <x-label for="name" value="{{ 'Nome do Visitante' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="cpf" x-mask="999.999.999-99" />
        <x-label for="cpf" value="{{ 'CPF' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="date" wire:model.live.debounce.500ms="date_of_birth" id="date_of_birth" />
        <x-label for="date_of_birth" wire:model="date_of_birth" value="{{ 'Data Nasc.' }}" />
    </div>
</div>

{{-- Linha 2 --}}
<div class="grid grid-cols-3 gap-6 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="phone" id="phone" x-mask="(99) 99999-9999" />
        <x-label for="phone" wire:model="phone" value="{{ 'Fone' }}" />
    </div>

    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="status" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'Status' }}</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="ATIVO">ATIVO</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="INATIVO">INATIVO</option>
        </select>
    </div>

    <div class="relative z-0 w-full group">
        <select id="sex_id" wire:model.live.debounce.500ms="sex_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $sex->id ?? '' }}">{{ $sex->id ?? 'Sexo' }}</option>
            @isset($sexes)
            @foreach ($sexes as $sex)
            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $sex->id ?? '' }}"
                @selected(old('sex_id')==$sex->id)>{{$sex->sex }}</option>
            @endforeach
            @endisset
        </select>
    </div>
</div>