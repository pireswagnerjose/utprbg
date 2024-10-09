{{-- Linha 1 --}}
<div class="grid grid-cols-2 mt-6">
    <div class="relative z-0 w-full group px-6">
        <select id="visitant_id" wire:model.live.debounce.500ms="visitant_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'Visitante' }}</option>
            @isset($visitants)
                @foreach ($visitants as $visitant)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $visitant->id }}">{{$visitant->name }}</option>
                @endforeach
            @endisset
        </select>
    </div>

    <div class="relative z-0 w-full group px-6">
        <select id="prisoner_id" wire:model.live.debounce.500ms="prisoner_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">{{ 'Preso' }}</option>
            @isset($prisoners)
                @foreach ($prisoners as $prisoner)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $prisoner->id }}">{{$prisoner->name }}</option>
                @endforeach
            @endisset
        </select>
    </div>
</div>