{{-- linha1 --}}
<div class="grid md:grid-cols-7 md:gap-6 mt-8">
    <div class="col-span-2 relative z-0 w-full group">
        <select id="family_id" wire:model="family_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $family->id ?? '' }}">{{ $family->id ?? 'Visitante' }}</option>
            @foreach ($families as $family)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $family->id ?? '' }}" @selected(old('family_id') ==  $family->id)>{{$family->name }}</option>
            @endforeach
        </select>
        <x-input-error for="family_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="date" id="date" />
        <x-label for="date" wire:model="date" value="{{ 'Data da Visita' }}" />
        <x-input-error for="date" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-2 relative z-0 w-full group">
        <select id="status" wire:model="status" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $status ?? '' }}">{{ $status ?? 'Status da Visita' }}</option>
            @foreach ($statuses as $status)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $status ?? '' }}" @selected(old('status') ==  $status)>{{$status}}</option>
            @endforeach
        </select>
        <x-input-error for="status" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-2 relative z-0 w-full group">
        <select id="type" wire:model="type" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $type ?? '' }}">{{ $type ?? 'Tipo da Visita' }}</option>
            @foreach ($types as $type)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $type ?? '' }}" @selected(old('type') ==  $type)>{{$type }}</option>
            @endforeach
        </select>
        <x-input-error for="type" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha2 --}}
<div class="relative z-0 w-full group mt-4">
    <label for="remark" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
    <textarea id="remark" wire:model="remark" rows="6"
        class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Observações">{{ old('remark', $remark ?? '') }}</textarea>
</div>