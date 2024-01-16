{{-- linha1 --}}
<div class="relative z-0 w-full group mt-8 flex items-center justify-center">
    <input type="file" id="document" wire:model.live="document" class="rounded-md" />
    <x-input-error for="document" class="mt-2" />
</div>
{{-- linha2 --}}
<div class="grid md:grid-cols-6 md:gap-6 mt-8">
    <div class="col-span-2 relative z-0 w-full group">
        <select id="type_care_id" wire:model="type_care_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $type_care->id ?? '' }}">{{ $type_care->id ?? 'Tipo do Atendimento' }}</option>
            @foreach ($type_cares as $type_care)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $type_care->id ?? '' }}" @selected(old('type_care_id') ==  $type_care->id)>{{$type_care->type_care }}</option>
            @endforeach
        </select>
        <x-input-error for="type_care_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-2 relative z-0 w-full group">
        <select id="modality_care_id" wire:model="modality_care_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $modality_care->id ?? '' }}">{{ $modality_care->id ?? 'Modalidade do Atendimento' }}</option>
            @foreach ($modality_cares as $modality_care)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $modality_care->id ?? '' }}" @selected(old('modality_care_id') ==  $modality_care->id)>{{$modality_care->modality_care }}</option>
            @endforeach
        </select>
        <x-input-error for="modality_care_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="date" id="date" />
        <x-label for="date" wire:model="date" value="{{ 'Data' }}" />
        <x-input-error for="date" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="time" id="time" x-mask="99:99" />
        <x-label for="time" wire:model="time" value="{{ 'Hora' }}" />
        <x-input-error for="time" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha3 --}}
<div class="grid md:grid-cols-4 md:gap-6 mt-8">
    <div class="col-span-1 relative z-0 w-full group">
        <select id="status" wire:model="status" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $status ?? '' }}">{{ $status ?? 'Status (mantido ou cancelado)' }}</option>
            @foreach ($statuses as $status)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $status ?? '' }}" @selected(old('status') ==  $status)>{{$status }}</option>
            @endforeach
        </select>
        <x-input-error for="status" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="lawyer_id" wire:model="lawyer_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $lawyer->id ?? '' }}">{{ $lawyer->id ?? 'Advogado' }}</option>
            @foreach ($lawyers as $lawyer)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $lawyer->id ?? '' }}" @selected(old('lawyer_id') ==  $lawyer->id)>{{$lawyer->lawyer }}</option>
            @endforeach
        </select>
        <x-input-error for="lawyer_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="district_id" wire:model="district_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $district->id ?? '' }}">{{ $district->id ?? 'Comarca da Audiência' }}</option>
            @foreach ($districts as $district)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $district->id ?? '' }}" @selected(old('district_id') ==  $district->id)>{{$district->district }}</option>
            @endforeach
        </select>
        <x-input-error for="district_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="criminal_court_id" wire:model="criminal_court_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $criminal_court->id ?? '' }}">{{ $criminal_court->id ?? 'Vara Criminal' }}</option>
            @foreach ($criminal_courts as $criminal_court)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $criminal_court->id ?? '' }}" @selected(old('criminal_court_id') ==  $criminal_court->id)>{{$criminal_court->criminal_court }}</option>
            @endforeach
        </select>
        <x-input-error for="criminal_court_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha5 --}}
<div class="relative z-0 w-full group mt-4">
    <label for="remark" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
    <textarea id="remark" wire:model="remark" rows="6"
        class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Observações">{{ old('remark', $remark ?? '') }}</textarea>
</div>