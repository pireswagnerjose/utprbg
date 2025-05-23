{{-- linha 1 --}}
<div class="grid md:grid-cols-6 gap-8 mb-6">
    <div class="md:col-span-3 relative z-0 w-full group">
        <x-input type="text" wire:model="name" />
        <x-label for="name" value="{{ 'Nome' }}" />
        <x-input-error for="name" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:col-span-2 relative z-0 w-full group">
        <x-input type="text" wire:model="nickname" />
        <x-label for="nickname" value="{{ 'Alcunha' }}" />
        <x-input-error for="nickname" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="date_birth" />
        <x-label for="date_birth" value="{{ 'Data Nasc.' }}" />
        <x-input-error for="date_birth" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 2 --}}
<div class="grid md:grid-cols-4 gap-8 mb-6">
    <div class="md:col-span-1 relative z-0 w-full group" x-data="{ data : ' ' }">
        <x-input type="text" wire:model="cpf" x-mask="999.999.999-99" />
        <x-label for="cpf" value="{{ 'CPF' }}" />
        <x-input-error for="cpf" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="rg" />
        <x-label for="rg" value="{{ 'RG' }}" />
        <x-input-error for="rg" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:col-span-1 relative z-0 w-full group" x-data="{ data : ' ' }">
        <x-input type="text" wire:model="title" x-mask="9999.9999.9999" />
        <x-label for="title" value="{{ 'Título de Eleitor' }}" />
        <x-input-error for="title" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="birth_certificate" />
        <x-label for="birth_certificate" value="{{ 'Certidão de Nascimento' }}" />
        <x-input-error for="birth_certificate" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 3 --}}
<div class="grid md:grid-cols-5 gap-8 mb-6">
    <div class="md:col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="reservist" />
        <x-label for="reservist" value="{{ 'Reservista' }}" />
        <x-input-error for="reservist" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:col-span-1 relative z-0 w-full group" x-data="{ data : ' ' }">
        <x-input type="text" wire:model="sus_card" x-mask="9999.9999.9999.9999" />
        <x-label for="sus_card" value="{{ 'Cartão SUS' }}" />
        <x-input-error for="sus_card" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:col-span-1 relative z-0 w-full group" x-data="{ data : ' ' }">
        <x-input type="text" wire:model="rji" x-mask="999999999-99" />
        <x-label for="rji" value="{{ 'RJI' }}" />
        <x-input-error for="rji" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="profession" />
        <x-label for="profession" value="{{ 'Profissão' }}" />
        <x-input-error for="profession" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:relative z-0 w-full group">
        <select wire:model="status_prison_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $status_prison->id ?? '' }}">{{
                $status_prison->id ?? 'Status da Prisão' }}</option>
            @isset($status_prisons)
                @foreach ($status_prisons as $status_prison)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $status_prison->id ?? '' }}"
                        @selected(old('status_prison_id')==$status_prison->id)>{{ $status_prison->status_prison }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="status_prison_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 4 --}}
<div class="grid md:grid-cols-2 gap-8 mb-6">
    <div class="md:col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="mother" />
        <x-label for="mother" value="{{ 'Mãe' }}" />
        <x-input-error for="mother" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="father" />
        <x-label for="father" value="{{ 'Pai' }}" />
        <x-input-error for="father" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 5 --}}
<div class="grid md:grid-cols-4 gap-8 mb-6">
    <div class="md:relative z-0 w-full group">
        <select wire:model="education_level_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $education_level->id ?? '' }}">{{
                $education_level->id ?? 'Escolaridade' }}</option>
            @isset($education_levels)
                @foreach ($education_levels as $education_level)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $education_level->id ?? '' }}"
                        @selected(old('education_level_id')==$education_level->id)>{{$education_level->education_level }}
                    </option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="education_level_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:relative z-0 w-full group">
        <select wire:model="civil_status_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $civil_status->id ?? '' }}">{{
                $civil_status->id ?? 'Estado Civil' }}</option>
            @isset($civil_statuses)
                @foreach ($civil_statuses as $civil_status)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $civil_status->id ?? '' }}"
                        @selected(old('civil_status_id')==$civil_status->id)>{{$civil_status->civil_status }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="civil_status_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:relative z-0 w-full group">
        <select wire:model="sex_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $sex->id ?? '' }}">
                {{ $sex->id ?? 'Sexo' }}</option>
            @isset($sexes)
                @foreach ($sexes as $sex)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $sex->id ?? '' }}"
                        @selected(old('sex_id')==$sex->id)>{{$sex->sex }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="sex_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:relative z-0 w-full group">
        <select wire:model="sexual_orientation_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $sexual_orientation->id ?? '' }}">
                {{ $sexual_orientation->id ?? 'Orientação Sexual' }}</option>
            @isset($sexual_orientations)
                @foreach ($sexual_orientations as $sexual_orientation)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $sexual_orientation->id ?? '' }}"
                        @selected(old('sexual_orientation_id')==$sexual_orientation->id)>{{$sexual_orientation->sexual_orientation }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="sexual_orientation_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 6 --}}
<div class="grid md:grid-cols-4 gap-8 mb-6">
    <div class="md:relative z-0 w-full group">
        <select wire:model="ethnicity_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $ethnicity->id ?? '' }}">
                {{ $ethnicity->id ?? 'Etnia' }}</option>
            @isset($ethnicities)
                @foreach ($ethnicities as $ethnicity)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $ethnicity->id ?? '' }}"
                        @selected(old('ethnicity_id')==$ethnicity->id)>{{$ethnicity->ethnicity }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="ethnicity_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:relative z-0 w-full group">
        <select wire:model="state_id" wire:change='selectMunicipality'
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $state->id ?? '' }}">
                {{ $state->id ?? 'UF' }}</option>
            @isset($states)
                @foreach ($states as $state)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $state->id ?? '' }}"
                        @selected(old('state_id')==$state->id)>{{$state->state }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="state_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:relative z-0 w-full group">
        <select wire:model="municipality_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $municipalityEdit->id ?? '' }}">{{
                $municipalityEdit->municipality ?? 'Naturalidade' }}</option>
            @isset($municipalities)
                @foreach ($municipalities as $municipality)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $municipality->id ?? '' }}"
                        @selected(old('municipality_id')==$municipality->id)>{{$municipality->municipality }} - {{$municipality->state->uf }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="municipality_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="md:relative z-0 w-full group">
        <select wire:model="country_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $country->id ?? '' }}">{{ $country->id
                ?? 'Nacionalidade' }}</option>
            @isset($countries)
                @foreach ($countries as $country)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $country->id ?? '' }}"
                        @selected(old('country_id')==$country->id)>{{$country->country }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="country_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 7 --}}
<div class="relative z-0 w-full group mb-6">
    <textarea wire:model="remarks" rows="6" class="
            block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md
            bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400
            text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Informações Complementares">
        {{ old('remarks', $prisoner->remarks ?? '') }}
    </textarea>
</div>