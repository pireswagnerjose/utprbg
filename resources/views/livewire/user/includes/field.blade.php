<div class="space-y-6">
    <div class="grid md:grid-cols-5 md:gap-6">
        <div class="col-span-2">
            <div class="relative z-0 w-full group">
                <x-input type="text" wire:model="userFirstName" id="userFirstName" required />
                <x-label for="userFirstName" wire:model="userFirstName" value="{{ 'Nome' }}" />
            </div>
            <x-input-error for="userFirstName" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
        <div class="col-span-2">
            <div class="relative z-0 w-full group">
                <x-input type="text" wire:model="userLastName" id="userLastName" required />
                <x-label for="userLastName" wire:model="userLastName" value="{{ 'Sobrenome' }}" />
            </div>
            <x-input-error for="userLastName" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
        <div class="">
            <div class="relative z-0 w-full group">
                <x-input type="text" wire:model="userRegistry" id="userRegistry" required />
                <x-label for="userRegistry" wire:model="userRegistry" value="{{ 'Matrícula' }}" />
            </div>
            <x-input-error for="userRegistry" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
    </div>
   <div class="grid md:grid-cols-4 md:gap-6">
        <div class="">
            <div class="relative z-0 w-full group">
                <x-input type="text" wire:model="userPhone" id="userPhone" required />
                <x-label for="userPhone" wire:model="userPhone" value="{{ 'Telefone' }}" />
            </div>
            <x-input-error for="userPhone" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
         <div class="">
            <div class="relative z-0 w-full group">
                <x-input-email-pass type="userEmail" wire:model="userEmail" id="userEmail" required />
                <x-label for="userEmail" wire:model="userEmail" value="{{ 'Email' }}" />
            </div>
            <x-input-error for="userEmail" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
        <div class="relative z-0 w-full group">
            <select id="userPrisonUnitId" required wire:model="userPrisonUnitId" class="block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $prison_unit->id ?? '' }}">{{ $prison_unit->id ?? 'Unidade Prisional' }}</option>
                @foreach ($prison_units as $prison_unit)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $prison_unit->id ?? '' }}" @selected(old('userPrisonUnitId') ==  $prison_unit->id)>{{$prison_unit->prison_unit }}</option>
                @endforeach
            </select>
            <x-input-error for="userPrisonUnitId" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>

        <div class="relative z-0 w-full group">
            <select id="userLevelAccessId" required wire:model="userLevelAccessId" class="block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $level_access->id ?? '' }}">{{ $level_access->level_access ?? 'Nível de Acesso' }}</option>
                @foreach ($level_accesses as $level_access)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $level_access->id }}" @selected(old('userLevelAccessId') ==  $level_access->id)>{{$level_access->level_access }}</option>
                @endforeach
            </select>
            <x-input-error for="userLevelAccessId" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
    </div>
    <div class="grid md:grid-cols-4 md:gap-6">
        <div class="col-span-2">
            <div class="relative z-0 w-full group">
                <x-input-email-pass type="password" wire:model="userPassword" id="userPassword" required />
                <x-label for="userPassword" wire:model="userPassword" value="{{ 'Senha' }}" />
            </div>
            <x-input-error for="userPassword" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
        {{-- <div class="">
            <div class="relative z-0 w-full group">
                <x-input type="password" wire:model="password_confirmation" id="password_confirmation" required />
                <x-label for="password_confirmation" wire:model="password_confirmation" value="{{ __('Password Confirmation') }}" />
            </div>
            <x-input-error for="password_confirmation" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div> --}}
        <div></div>
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">
                Adicionar
            </button>
            <button wire:click.prevent="cancel" type="submit" class="ml-4 px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600">
                Cancelar
            </button>
        </div>
    </div>
</div>
