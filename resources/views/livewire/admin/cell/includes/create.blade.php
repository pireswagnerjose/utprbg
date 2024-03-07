<div class="container content py-6 mx-auto w-3/4">
    <div class="mx-auto">
        <form wire:submit="create">
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="relative z-0 w-full group">
                    <select required wire:model="wardID" class="block py-1 px-0 w-full uppercase text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                        <option class="text-zinc-900 dark:text-zinc-600 text-xs" selected value="{{ $state->id ?? '' }}">{{ $state->id ?? 'Ala - Pavilhão' }}</option>
                        @foreach ($wards as $ward)
                            <option class="text-zinc-900 dark:text-zinc-100 text-base" value="{{ $ward->id ?? '' }}" @selected(old('wardID') ==  $ward->id)>{{$ward->ward }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="wardID" class="mt-2">{{ $message ?? '' }}</x-input-error>
                </div>
                <div class="relative z-0 w-full group">
                    <x-input type="text" wire:model="cell" required />
                    <x-label for="cell" value="{{ 'Cela' }}" />
                    <x-input-error for="cell" class="mt-2">{{ $message ?? '' }}</x-input-error>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <x-button> {{ 'Adicionar' }} </x-button>
                <x-danger-button class="ms-3" wire:click.prevent="cancel">{{ 'Cancelar' }}</x-danger-button>
            </div>
            @if (session('success'))
                <span class="text-green-500 text-sm">{{ session('success') }}</span>
            @endif
        </form>
    </div>
</div>