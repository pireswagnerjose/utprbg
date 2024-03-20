{{-- linha 1 --}}
<div class="grid md:grid-cols-4 mb-8 mt-12 md:gap-6">
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="date_arrest" id="date_arrest" />
        <x-label for="date_arrest" wire:model="date_arrest" value="{{ 'Data da Prisão no Processo' }}" />
        <x-input-error for="date_arrest" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="date_exit" id="date_exit" maxlength="10" />
        <x-label for="date_exit" wire:model="date_exit" value="{{ 'Data do Alvará no Processo' }}" />
        <x-input-error for="date_exit" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-2 relative z-0 w-full group">
        <select id="origin_process_id" required wire:model="origin_process_id" class="block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $origin_process->id ?? '' }}">{{ $origin_process->id ?? 'Origem do Processo' }}</option>
            @foreach ($origin_processes as $origin_process)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $origin_process->id ?? '' }}" @selected(old('origin_process_id') ==  $origin_process->id)>{{ $origin_process->origin_process }}</option>
            @endforeach
        </select>
        <x-input-error for="origin_process_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 2 --}}
<div class="grid md:grid-cols-3 mb-8 md:gap-6">
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="judicial_district_origin" id="judicial_district_origin" />
        <x-label for="judicial_district_origin" wire:model="judicial_district_origin" value="{{ 'Comarca de Origem' }}" />
        <x-input-error for="judicial_district_origin" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="process_regime_id" required wire:model="process_regime_id" class="block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $process_regime->id ?? '' }}">{{ $process_regime->id ?? 'Regime do Processo' }}</option>
            @foreach ($process_regimes as $process_regime)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $process_regime->id ?? '' }}" @selected(old('process_regime_id') ==  $process_regime->id)>{{ $process_regime->process_regime }}</option>
            @endforeach
        </select>
        <x-input-error for="process_regime_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group" x-data>
        <x-input type="text" wire:model="eproc" id="eproc" maxlength="24" x-mask="9999999-99.9999.999.9999" />
        <x-label for="eproc" wire:model="eproc" value="{{ 'EPROC' }}" />
        <x-input-error for="eproc" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 3 --}}
<div class="grid md:grid-cols-3 mb-8 md:gap-6">
    <div class="col-span-1 relative z-0 w-full group" x-data>
        <x-input type="text" wire:model="seeu" id="seeu" maxlength="25" x-mask="9999999-99.9999.9.99.9999" />
        <x-label for="seeu" wire:model="seeu" value="{{ 'SEEU' }}" />
        <x-input-error for="seeu" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="pje" id="pje" maxlength="24" />
        <x-label for="pje" wire:model="pje" value="{{ 'PJE' }}" />
        <x-input-error for="pje" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="apf" id="apf" maxlength="25" />
        <x-label for="apf" wire:model="apf" value="{{ 'APF' }}" />
        <x-input-error for="apf" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>
{{-- linha 4 --}}
<div class="relative z-0 w-full group">
    <label for="remark" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
    <textarea id="remark" wire:model="remark" rows="6"
        class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Observações">{{ old('remark', $prison->remark ?? '') }}</textarea>
</div>