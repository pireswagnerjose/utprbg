<div class="w-full">
    <div class="grid md:grid-cols-2 md:gap-8 mb-8 mt-12">
        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="date" wire:model="date" />
            <x-label for="date" value="{{ 'Data Inicial' }}" />
            <x-input-error for="date" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>

        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="text" wire:model="number_visit" />
            <x-label for="number_visit" value="{{ 'Quantidade de Visitante' }}" />
            <x-input-error for="number_visit" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
    </div>

    <div class="grid md:grid-cols-2 md:gap-8 mb-8">
        <div class="col-span-1 z-0 w-full group">
            <select wire:model="visist_type" class="uppercase block py-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600 text-xs" selected value="{{ $visist_type ?? '' }}">{{ $visist_type ?? 'Tipo da Visita (social ou íntima)' }}</option>
                @foreach ($visit_types as $visit_type_value)
                    <option class="text-zinc-900 dark:text-zinc-100 text-base" value="{{ $visit_type_value ?? '' }}" @selected(old('visit_type') ==  $visit_type_value)>{{ $visit_type_value }}</option>
                @endforeach
            </select>
            <x-input-error for="visist_type" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>

        <div class="col-span-1 z-0 w-full group">
            <select wire:model="ward_id" class="uppercase block py-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600 text-xs" selected value="{{ $ward->id ?? '' }}">{{ $ward->id ?? 'Ala - Pavilhão' }}</option>
                @foreach ($wards as $ward)
                    <option class="text-zinc-900 dark:text-zinc-100 text-base" value="{{ $ward->id ?? '' }}" @selected(old('ward_id') ==  $ward->id)>{{$ward->ward }}</option>
                @endforeach
            </select>
            <x-input-error for="ward_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
    </div>
</div>