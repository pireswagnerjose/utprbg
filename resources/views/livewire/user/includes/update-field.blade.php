<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="first_name" wire:model="userFirstName" />
        <x-label for="first_name" wire:model="first_name" value="{{ __('First Name') }}" />
        <x-input-error for="first_name" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" id="last_name" wire:model="userLastName" />
        <x-label for="last_name" wire:model="last_name" value="{{ __('Last Name') }}" />
        <x-input-error for="last_name" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="registry" wire:model="userRegistry" />
        <x-label for="registry" wire:model="registry" value="{{ __('Registry') }}" />
        <x-input-error for="registry" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <x-input type="text" id="phone" wire:model="userPhone" />
        <x-label for="phone" wire:model="phone" value="{{ __('Phone') }}" />
        <x-input-error for="phone" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

<div class="grid gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input-email-pass type="text" id="email" wire:model="userEmail" />
        <x-label for="userEmail" wire:model="userEmail" value="{{ __('Email') }}" />
        <x-input-error for="email" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <select id="prison_unit_id" required wire:model="userPrisonUnitId" class="block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            @foreach ($prison_units as $prison_unit)
                <option class="text-zinc-900 dark:text-zinc-600" selected="userPrisonUnitId" value="{{ $prison_unit->id }}" @selected(old('prison_unit_id') ==  $prison_unit->id)>{{$prison_unit->prison_unit }}</option>
            @endforeach
        </select>
        <x-input-error for="userPrisonUnitId" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="relative z-0 w-full group">
        <select id="level_access_id" required wire:model="userLevelAccessId" class="block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            @foreach ($level_accesses as $level_access)
                <option class="text-zinc-900 dark:text-zinc-600" selected="userLevelAccessId" value="{{ $level_access->id }}" @selected(old('level_access_id') ==  $level_access->id)>{{$level_access->level_access }}</option>
            @endforeach
        </select>
        <x-input-error for="userLevelAccessId" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>