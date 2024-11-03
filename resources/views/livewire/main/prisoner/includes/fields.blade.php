{{-- linha 1 --}}
<div class="grid md:grid-cols-6 md:gap-8 mb-8 mt-12">
    <div class="col-span-3 relative z-0 w-full group">
        <x-input type="text" wire:model="prisonerForm.name" />
        <x-label for="prisonerForm.name" value="{{ 'Nome' }}" />
        <x-input-error for="prisonerForm.name" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="col-span-2 relative z-0 w-full group">
        <x-input type="text" wire:model="prisonerForm.nickname" />
        <x-label for="prisonerForm.nickname" value="{{ 'Alcunha' }}" />
        <x-input-error for="prisonerForm.nickname" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="prisonerForm.date_birth" />
        <x-label for="prisonerForm.date_birth" value="{{ 'Data Nasc.' }}" />
        <x-input-error for="prisonerForm.date_birth" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 2 --}}
<div class="grid md:grid-cols-4 mb-8 md:gap-6">
    <div class="col-span-1 relative z-0 w-full group" x-data="{ data : ' ' }">
        <x-input type="text" wire:model="prisonerForm.cpf" x-mask="999.999.999-99" />
        <x-label for="prisonerForm.cpf" value="{{ 'CPF' }}" />
        <x-input-error for="prisonerForm.cpf" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="prisonerForm.rg" />
        <x-label for="prisonerForm.rg" value="{{ 'RG' }}" />
        <x-input-error for="prisonerForm.rg" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="col-span-1 relative z-0 w-full group" x-data="{ data : ' ' }">
        <x-input type="text" wire:model="prisonerForm.title" x-mask="9999.9999.9999" />
        <x-label for="prisonerForm.title" value="{{ 'Título de Eleitor' }}" />
        <x-input-error for="prisonerForm.title" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="prisonerForm.birth_certificate" />
        <x-label for="prisonerForm.birth_certificate" value="{{ 'Certidão de Nascimento' }}" />
        <x-input-error for="prisonerForm.birth_certificate" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 3 --}}
<div class="grid md:grid-cols-5 mb-8 md:gap-6">
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="prisonerForm.reservist" />
        <x-label for="prisonerForm.reservist" value="{{ 'Reservista' }}" />
        <x-input-error for="prisonerForm.reservist" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="col-span-1 relative z-0 w-full group" x-data="{ data : ' ' }">
        <x-input type="text" wire:model="prisonerForm.sus_card" x-mask="9999.9999.9999.9999" />
        <x-label for="prisonerForm.sus_card" value="{{ 'Cartão SUS' }}" />
        <x-input-error for="prisonerForm.sus_card" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="col-span-1 relative z-0 w-full group" x-data="{ data : ' ' }">
        <x-input type="text" wire:model="prisonerForm.rji" x-mask="999999999-99" />
        <x-label for="prisonerForm.rji" value="{{ 'RJI' }}" />
        <x-input-error for="prisonerForm.rji" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="prisonerForm.profession" />
        <x-label for="prisonerForm.profession" value="{{ 'Profissão' }}" />
        <x-input-error for="prisonerForm.profession" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="relative z-0 w-full group">
        <select wire:model="prisonerForm.status_prison_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $prisonerForm->status_prison->id ?? '' }}">{{
                $prisonerForm->status_prison->id ?? 'Status da Prisão' }}</option>
            @isset($prisonerForm->status_prisons)
                @foreach ($prisonerForm->status_prisons as $status_prison)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $status_prison->id ?? '' }}"
                        @selected(old('status_prison_id')==$status_prison->id)>{{ $status_prison->status_prison }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="prisonerForm.status_prison_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 4 --}}
<div class="grid md:grid-cols-2 mb-10 md:gap-6">
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="prisonerForm.mother" />
        <x-label for="prisonerForm.mother" value="{{ 'Mãe' }}" />
        <x-input-error for="prisonerForm.mother" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="prisonerForm.father" />
        <x-label for="prisonerForm.father" value="{{ 'Pai' }}" />
        <x-input-error for="prisonerForm.father" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 5 --}}
<div class="grid md:grid-cols-4 mb-10 md:gap-6">
    <div class="relative z-0 w-full group">
        <select wire:model="prisonerForm.education_level_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $prisonerForm->education_level->id ?? '' }}">{{
                $prisonerForm->education_level->id ?? 'Escolaridade' }}</option>
            @isset($prisonerForm->education_levels)
                @foreach ($prisonerForm->education_levels as $education_level)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $education_level->id ?? '' }}"
                        @selected(old('education_level_id')==$education_level->id)>{{$education_level->education_level }}
                    </option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="prisonerForm.education_level_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="relative z-0 w-full group">
        <select wire:model="prisonerForm.civil_status_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $prisonerForm->civil_status->id ?? '' }}">{{
                $prisonerForm->civil_status->id ?? 'Estado Civil' }}</option>
            @isset($prisonerForm->civil_statuses)
                @foreach ($prisonerForm->civil_statuses as $civil_status)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $civil_status->id ?? '' }}"
                        @selected(old('civil_status_id')==$civil_status->id)>{{$civil_status->civil_status }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="prisonerForm.civil_status_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="relative z-0 w-full group">
        <select wire:model="prisonerForm.sex_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $prisonerForm->sex->id ?? '' }}">
                {{ $prisonerForm->sex->id ?? 'Sexo' }}</option>
            @isset($prisonerForm->sexes)
                @foreach ($prisonerForm->sexes as $sex)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $sex->id ?? '' }}"
                        @selected(old('sex_id')==$sex->id)>{{$sex->sex }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="prisonerForm.sex_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="relative z-0 w-full group">
        <select wire:model="prisonerForm.sexual_orientation_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $prisonerForm->sexual_orientation->id ?? '' }}">
                {{ $prisonerForm->sexual_orientation->id ?? 'Orientação Sexual' }}</option>
            @isset($prisonerForm->sexual_orientations)
                @foreach ($prisonerForm->sexual_orientations as $sexual_orientation)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $sexual_orientation->id ?? '' }}"
                        @selected(old('sexual_orientation_id')==$sexual_orientation->id)>{{$sexual_orientation->sexual_orientation }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="prisonerForm.sexual_orientation_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 6 --}}
<div class="grid md:grid-cols-4 mb-6 md:gap-6">
    <div class="relative z-0 w-full group">
        <select wire:model="prisonerForm.ethnicity_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $ethnicity->id ?? '' }}">
                {{ $ethnicity->id ?? 'Etnia' }}</option>
            @isset($prisonerForm->ethnicities)
                @foreach ($prisonerForm->ethnicities as $ethnicity)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $ethnicity->id ?? '' }}"
                        @selected(old('ethnicity_id')==$ethnicity->id)>{{$ethnicity->ethnicity }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="prisonerForm.ethnicity_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="relative z-0 w-full group">
        <select wire:model="prisonerForm.state_id" wire:change='selectMunicipality'
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $prisonerForm->state->id ?? '' }}">
                {{ $prisonerForm->state->id ?? 'UF' }}</option>
            @isset($prisonerForm->states)
                @foreach ($prisonerForm->states as $state)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $state->id ?? '' }}"
                        @selected(old('state_id')==$state->id)>{{$state->state }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="prisonerForm.state_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="relative z-0 w-full group">
        <select wire:model="prisonerForm.municipality_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $municipalityEdit->id ?? '' }}">{{
                $municipalityEdit->municipality ?? 'Naturalidade' }}</option>
            @isset($prisonerForm->municipalities)
                @foreach ($prisonerForm->municipalities as $municipality)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $municipality->id ?? '' }}"
                        @selected(old('municipality_id')==$municipality->id)>{{$municipality->municipality }} - {{$municipality->state->uf }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="prisonerForm.municipality_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    {{--  --}}
    <div class="relative z-0 w-full group">
        <select wire:model="prisonerForm.country_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $country->id ?? '' }}">{{ $country->id
                ?? 'Nacionalidade' }}</option>
            @isset($prisonerForm->countries)
                @foreach ($prisonerForm->countries as $country)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $country->id ?? '' }}"
                        @selected(old('country_id')==$country->id)>{{$country->country }}</option>
                @endforeach
            @endisset
        </select>
        <x-input-error for="prisonerForm.country_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 7 --}}
<div class="relative z-0 w-full group mb-6">
    <textarea wire:model="prisonerForm.remarks" rows="6" class="
            block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md
            bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400
            text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Informações Complementares">
        {{ old('remarks', $prisoner->remarks ?? '') }}
    </textarea>
</div>