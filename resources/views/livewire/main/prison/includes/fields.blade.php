{{-- linha 1 --}}
<div class="grid md:grid-cols-4 mb-8 mt-12 md:gap-6">
    <div class="col-span-2 relative z-0 w-full group">
        <select id="prison_unit_id" required wire:model="prison_unit_id" class="block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $prisonUnit->id ?? '' }}">{{ $prisonUnit->id ?? 'Unidade Prisional' }}</option>
            @foreach ($prisonUnits as $prisonUnit)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $prisonUnit->id ?? '' }}" @selected(old('prison_unit_id') ==  $prisonUnit->id)>{{ $prisonUnit->prison_unit }}</option>
            @endforeach
        </select>
        <x-input-error for="prison_unit_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="entry_date" id="entry_date" />
        <x-label for="entry_date" wire:model="entry_date" value="{{ 'Data da Entrada' }}" />
        <x-input-error for="entry_date" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="exit_date" id="exit_date" />
        <x-label for="exit_date" wire:model="exit_date" value="{{ 'Data da Saída' }}" />
        <x-input-error for="exit_date" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 2 --}}
<div class="grid md:grid-cols-3 mb-8 md:gap-6">
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="sentence" id="sentence" />
        <x-label for="sentence" wire:model="sentence" value="{{ 'Pena (anos, meses, dias)' }}" />
        <x-input-error for="sentence" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="exit_forecast" id="exit_forecast" />
        <x-label for="exit_forecast" wire:model="exit_forecast" value="{{ 'Previsão de Saída' }}" />
        <x-input-error for="exit_forecast" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="sentence_certificate" id="sentence_certificate" />
        <x-label for="sentence_certificate" wire:model="sentence_certificate" value="{{ 'Último Atestado de Pena' }}" />
        <x-input-error for="sentence_certificate" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 3 --}}
<div class="grid md:grid-cols-3 mb-8 md:gap-6">
    <div class="col-span-1 relative z-0 w-full group">
        <select id="prison_origin_id" required wire:model="prison_origin_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $prisonOrigin->id ?? '' }}">{{ $prisonOrigin->id ?? 'Origem da Prisão' }}</option>
            @foreach ($prisonOrigins as $prisonOrigin)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $prisonOrigin->id ?? '' }}" @selected(old('prison_origin_id') ==  $prisonOrigin->id)>{{ $prisonOrigin->prison_origin }}</option>
            @endforeach
        </select>
        <x-input-error for="prison_origin_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="type_prison_id" required wire:model="type_prison_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $typePrison->id ?? '' }}">{{ $typePrison->id ?? 'Tipo de Prisão' }}</option>
            @foreach ($typePrisons as $typePrison)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $typePrison->id ?? '' }}" @selected(old('type_prison_id') ==  $typePrison->id)>{{ $typePrison->type_prison }}</option>
            @endforeach
        </select>
        <x-input-error for="type_prison_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="output_type_id" required wire:model="output_type_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $outputType->id ?? '' }}">{{ $outputType->id ?? 'Tipo de Saída' }}</option>
            @foreach ($outputTypes as $outputType)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $outputType->id ?? '' }}" @selected(old('output_type_id') ==  $outputType->id)>{{ $outputType->output_type }}</option>
            @endforeach
        </select>
        <x-input-error for="output_type_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>
{{-- linha 4 --}}
<div class="relative z-0 w-full group">
    <label for="remarks" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
    <textarea id="remarks" wire:model="remarks" rows="6"
        class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Observações sobre a prisão">{{ old('remarks', $prison->remarks ?? '') }}</textarea>
</div>