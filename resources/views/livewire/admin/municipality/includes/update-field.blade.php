<div class="grid grid-cols-3 gap-4 mt-6">
    <div class="relative col-span-2 z-0 w-full group">
        <x-input type="text" id="municipality" wire:model="municipality" />
        <x-label for="municipality" wire:model="municipality" value="{{ 'Estado' }}" />
        <x-input-error for="municipality" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <select id="stateID" required wire:model="stateID" class="block py-1 px-0 w-full uppercase text-base text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            @foreach ($states as $state)
                <option class="text-zinc-900 dark:text-white" selected="stateID" value="{{ $state->id ?? '' }}" @selected(old('stateID') ==  $state->id)>
                    {{$state->state }}
                </option>
            @endforeach
        </select>
        <x-input-error for="stateID" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>