<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <select required wire:model="wardID" class="block py-1 px-0 w-full uppercase text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            @foreach ($wards as $ward)
            <option class="text-zinc-900 dark:text-white" selected="wardID" value="{{ $ward->id ?? '' }}" @selected(old('wardID') ==  $ward->id)>
                {{$ward->ward }}
            </option>
            @endforeach
        </select>
        <x-input-error for="wardID" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model="cell" />
        <x-label for="cell" value="{{ 'cela' }}" />
        <x-input-error for="cell" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>