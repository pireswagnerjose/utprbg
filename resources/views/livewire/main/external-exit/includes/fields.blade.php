{{-- linha1 --}}
<div class="relative z-0 w-full group mt-8 flex items-center justify-center">
    <input type="file" id="document" wire:model.live="document" class="rounded-md" />
    <x-input-error for="document" class="mt-2" />
</div>
{{-- linha2 --}}
<div class="grid md:grid-cols-3 md:gap-6 mt-8">
    <div class="col-span-1 relative z-0 w-full group">
        <select id="prison_unit_id" wire:model="prison_unit_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $prison_unit->id ?? '' }}">{{ $prison_unit->id ?? 'Unidade Prisional' }}</option>
            @foreach ($prison_units as $prison_unit)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $prison_unit->id ?? '' }}" @selected(old('prison_unit_id') ==  $prison_unit->id)>{{$prison_unit->prison_unit }}</option>
            @endforeach
        </select>
        <x-input-error for="prison_unit_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="requesting_id" wire:model="requesting_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $requesting->id ?? '' }}">{{ $requesting->id ?? 'Requisitante' }}</option>
            @foreach ($requestings as $requesting)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $requesting->id ?? '' }}" @selected(old('requesting_id') ==  $requesting->id)>{{$requesting->requesting }}</option>
            @endforeach
        </select>
        <x-input-error for="requestings_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="exit_reason_id" wire:model="exit_reason_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $exit_reason->id ?? '' }}">{{ $exit_reason->id ?? 'Motivo da Saída' }}</option>
            @foreach ($exit_reasons as $exit_reason)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $exit_reason->id ?? '' }}" @selected(old('exit_reason_id') ==  $exit_reason->id)>{{$exit_reason->exit_reason }}</option>
            @endforeach
        </select>
        <x-input-error for="exit_reason_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha3 --}}
<div class="grid md:grid-cols-3 md:gap-6 mt-8">
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="exit_date" id="exit_date" />
        <x-label for="exit_date" wire:model="exit_date" value="{{ 'Data da Saída' }}" />
        <x-input-error for="exit_date" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="departure_time" id="departure_time" x-mask="99:99" />
        <x-label for="departure_time" wire:model="departure_time" value="{{ 'Hora da Saída' }}" />
        <x-input-error for="departure_time" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="arrival_time" id="arrival_time" x-mask="99:99" />
        <x-label for="arrival_time" wire:model="arrival_time" value="{{ 'Hora do Retorno' }}" />
        <x-input-error for="arrival_time" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha4 --}}
<div class="grid md:grid-cols-3 md:gap-6 mt-8">
    <div class="col-span-1 relative z-0 w-full group">
        <select id="status" wire:model="status" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $status ?? '' }}">{{ $status ?? 'Status (mantido ou cancelado)' }}</option>
            @foreach ($statuses as $status)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $status ?? '' }}" @selected(old('status') ==  $status)>{{$status }}</option>
            @endforeach
        </select>
        <x-input-error for="status" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="state_id" wire:model="state_id" wire:change='selectMunicipality' class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $state->id ?? '' }}">{{ $state->id ?? 'UF' }}</option>
            @foreach ($states->all(['id']) as $state)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $state->id ?? '' }}" @selected(old('state_id') ==  $state->id)>{{$state->state }}</option>
            @endforeach
        </select>
        <x-input-error for="state_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="municipality_id" wire:model="municipality_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $municipalityEdit->id ?? '' }}">{{ $municipalityEdit->municipality ?? 'Naturalidade' }}</option>
            @foreach ($municipalities as $municipality)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $municipality->id ?? '' }}" @selected(old('municipality_id') ==  $municipality->id)>{{$municipality->municipality }} - {{$municipality->state->uf }}</option>
            @endforeach
        </select>
        <x-input-error for="municipality_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha5 --}}
<div class="relative z-0 w-full group mt-4">
    <label for="remark" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
    <textarea id="remark" wire:model="remark" rows="6"
        class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Observações">{{ old('remark', $external_exit->remark ?? '') }}</textarea>
</div>