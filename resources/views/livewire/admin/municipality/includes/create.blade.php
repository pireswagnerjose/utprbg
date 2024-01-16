<div class="container content py-6 mx-auto w-3/4">
    <div class="mx-auto">
        <form wire:submit="create">
            <div class="mb-6 grid grid-cols-3 gap-4">
                <div class="relative col-span-2 z-0 w-full group">
                    <x-input type="text" id="municipality" wire:model="municipality" required />
                    <x-label for="municipality" wire:model="municipality" value="{{ 'Município' }}" />
                    <x-input-error for="municipality" class="mt-2">{{ $message ?? '' }}</x-input-error>
                </div>
                <div class="relative z-0 w-full group">
                    <select id="stateID" required wire:model="stateID" class="block py-1 px-0 w-full uppercase text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                        <option class="text-zinc-900 dark:text-zinc-600 text-xs" selected value="{{ $state->id ?? '' }}">{{ $state->id ?? 'Estado' }}</option>
                        @foreach ($states as $state)
                            <option class="text-zinc-900 dark:text-zinc-100 text-base" value="{{ $state->id ?? '' }}" @selected(old('stateID') ==  $state->id)>{{$state->state }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="stateID" class="mt-2">{{ $message ?? '' }}</x-input-error>
                </div>
            </div>
            <div class="flex justify-end">
                <x-button> {{ 'Adicionar' }} </x-button>
                <x-danger-button class="ms-3" wire:click.prevent="cancel">{{ 'Cancelar' }}</x-danger-button>
            </div>
            @if (session('success'))
                <span class="text-green-500 text-sm">{{ session('success') }}</span>
            @endif
        </form>
    </div>
</div>