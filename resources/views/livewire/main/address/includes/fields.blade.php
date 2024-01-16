{{-- linha1 --}}
<div class="grid md:grid-cols-6 md:gap-6 mt-8">
    <div class="col-span-3 relative z-0 w-full group">
        <x-input type="text" wire:model="street" id="street" />
        <x-label for="street" wire:model="street" value="{{ 'Logradouro (Ex. Rua, Av. Alameda, etc.)' }}" />
        <x-input-error for="street" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="number" id="number" />
        <x-label for="number" wire:model="number" value="{{ 'Número' }}" />
        <x-input-error for="number" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-2 relative z-0 w-full group">
        <x-input type="text" wire:model="complement" id="complement" />
        <x-label for="complement" wire:model="complement" value="{{ 'Complemento' }}" />
        <x-input-error for="complement" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha2 --}}
<div class="grid md:grid-cols-3 md:gap-6 mt-8">
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="barrio" id="barrio" />
        <x-label for="barrio" wire:model="barrio" value="{{ 'Bairro' }}" />
        <x-input-error for="barrio" class="mt-2">{{ $message ?? '' }}</x-input-error>
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

{{-- linha3 --}}
<div class="relative z-0 w-full group">
    <label for="remark" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
    <textarea id="remark" wire:model="remark" rows="6"
        class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Observações">{{ old('remark', $address->remark ?? '') }}</textarea>
</div>