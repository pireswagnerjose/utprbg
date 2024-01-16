{{-- linha 1 --}}
<div class="grid md:grid-cols-4 md:gap-6 mb-8 mt-12">
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="date" id="date" x-mask="99/99/9999" />
        <x-label for="date" wire:model="date" value="{{ 'Data' }}" />
        <x-input-error for="date" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>

    <div class="col-span-2 relative z-0 w-full group">
        <select id="ward_id" required wire:model="ward_id" class="block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $ward->id ?? '' }}">{{ $ward->id ?? 'Pavilhão' }}</option>
            @foreach ($wards as $ward)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $ward->id ?? '' }}" @selected(old('ward_id') ==  $ward->id)>{{ $ward->ward }}</option>
            @endforeach
        </select>
        <x-input-error for="ward_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>

    <div class="col-span-1 relative z-0 w-full group">
        <select id="cell_id" required wire:model="cell_id" class="block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $cell->id ?? '' }}">{{ $cell->id ?? 'Cela' }}</option>
            @foreach ($cells as $cell)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $cell->id ?? '' }}" @selected(old('cell_id') ==  $cell->id)>{{ $cell->cell }}</option>
            @endforeach
        </select>
        <x-input-error for="cell_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>