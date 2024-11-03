{{-- Linha 1 --}}
<div class="grid grid-cols-4 gap-6 mt-6">
    <div class="relative col-span-2 z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="visitantForm.name" />
        <x-label for="visitantForm.name" value="{{ 'Nome do Visitante' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="visitantForm.cpf" x-mask="999.999.999-99" />
        <x-label for="visitantForm.cpf" value="{{ 'CPF' }}" />
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="date" wire:model.live.debounce.500ms="visitantForm.date_of_birth" />
        <x-label for="visitantForm.date_of_birth" value="{{ 'Data Nasc.' }}" />
    </div>
</div>

{{-- Linha 2 --}}
<div class="grid grid-cols-3 gap-6 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model.live.debounce.500ms="visitantForm.phone" x-mask="(99) 99999-9999" />
        <x-label for="visitantForm.phone" value="{{ 'Fone' }}" />
    </div>

    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="visitantForm.status" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'Status' }}</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="ATIVO">ATIVO</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="INATIVO">INATIVO</option>
        </select>
    </div>

    <div class="relative z-0 w-full group">
        <select wire:model.live.debounce.500ms="visitantForm.sex_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $this->visitantForm->sex->id ?? '' }}">{{ $this->visitantForm->sex->id ?? 'Sexo' }}</option>
            @isset($this->visitantForm->sexes)
                @foreach ($this->visitantForm->sexes as $sex)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $sex->id ?? '' }}"
                        @selected(old('visitantForm.sex_id')==$sex->id)>{{$sex->sex }}</option>
                @endforeach
            @endisset
        </select>
    </div>
</div>