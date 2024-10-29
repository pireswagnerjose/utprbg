{{-- linha1 --}}
<div class="grid md:grid-cols-2 md:gap-6 mt-16">
    {{-- Delegado --}}
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="hearing_with_police_officer_form.delegate" />
        <x-label for="hearing_with_police_officer_form.delegate" value="{{ 'Delegado' }}" />
        <x-input-error for="hearing_with_police_officer_form.delegate" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>

    {{-- Delegacia --}}
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="hearing_with_police_officer_form.police_station" />
        <x-label for="hearing_with_police_officer_form.police_station" value="{{ 'Delegacia' }}" />
        <x-input-error for="hearing_with_police_officer_form.police_station" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>

    {{-- Tipo do Atendimento --}}
    <div class="relative z-0 w-full group">
        <select wire:model="hearing_with_police_officer_form.modality_care_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $modality_care->id ?? '' }}">{{ $modality_care->id ?? 'Tipo do Atendimento' }}</option>
            @foreach ($modality_cares as $modality_care)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $modality_care->id ?? '' }}" @selected(old('hearing_with_police_officer_form.modality_care_id') ==  $modality_care->id)>{{$modality_care->modality_care }}</option>
            @endforeach
        </select>
        <x-input-error for="hearing_with_police_officer_form.modality_care_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha2 --}}
<div class="grid md:grid-cols-3 md:gap-6 mt-8">
    {{-- Data do Atendimento --}}
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="hearing_with_police_officer_form.date_of_service" />
        <x-label for="hearing_with_police_officer_form.date_of_service" value="{{ 'Data do Atendimento' }}" />
        <x-input-error for="hearing_with_police_officer_form.date_of_service" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>

    {{-- Hora do Atendimento --}}
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="hearing_with_police_officer_form.time_of_service" x-mask="99H99" />
        <x-label for="hearing_with_police_officer_form.time_of_service" value="{{ 'Hora do Atendimento' }}" />
        <x-input-error for="hearing_with_police_officer_form.time_of_service" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>

    {{-- Status: Mantido ou Cancelado --}}
    <div class="col-span-1 relative z-0 w-full group"> 
        <select wire:model="hearing_with_police_officer_form.status" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $status->status ?? '' }}">{{ $status->status ?? 'Status' }}</option>
            @foreach ($statuses as $status)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $status ?? '' }}" @selected(old('hearing_with_police_officer_form.status') ==  $status)>{{ $status }}</option>
            @endforeach
        </select>
        <x-input-error for="hearing_with_police_officer_form.status" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha3 --}}
<div class="relative z-0 w-full group mt-6">
    <label for="hearing_with_police_officer_form.remark" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
    <textarea wire:model="hearing_with_police_officer_form.remark" rows="6"
        class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Observações">{{ old('hearing_with_police_officer_form.remark', $hearing_with_police_officer->remark ?? '') }}</textarea>
</div>