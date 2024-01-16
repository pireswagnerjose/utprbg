{{-- linha1 --}}
<div class="grid md:grid-cols-5 md:gap-6 mt-8">
    <div class="col-span-1 relative z-0 w-full group">
        <select id="pad_type_of_occurrence_id" wire:model="pad_type_of_occurrence_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $pad_type_of_occurrence->id ?? '' }}">{{ $pad_type_of_occurrence->id ?? 'Tipo de Ocorrência' }}</option>
            @foreach ($pad_type_of_occurrences as $pad_type_of_occurrence)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $pad_type_of_occurrence->id ?? '' }}" @selected(old('pad_type_of_occurrence_id') ==  $pad_type_of_occurrence->id)>{{$pad_type_of_occurrence->pad_type_of_occurrence }}</option>
            @endforeach
        </select>
        <x-input-error for="pad_type_of_occurrence_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="register_number" id="register_number" />
        <x-label for="register_number" wire:model="register_number" value="{{ 'Número da Ocorrência' }}" />
        <x-input-error for="register_number" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="opening_date" id="opening_date" />
        <x-label for="opening_date" wire:model="opening_date" value="{{ 'Data da Abertura' }}" />
        <x-input-error for="opening_date" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="text" wire:model="opening_time" id="opening_time" x-mask="99:99" />
        <x-label for="opening_time" wire:model="opening_time" value="{{ 'Horário da Ocorrência' }}" />
        <x-input-error for="opening_time" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" wire:model="completion_date" id="completion_date" />
        <x-label for="completion_date" wire:model="completion_date" value="{{ 'Data da Conclusão' }}" />
        <x-input-error for="completion_date" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>
{{-- linha2 --}}
<div class="grid md:grid-cols-4 md:gap-6 mt-8">
    <div class="col-span-1 relative z-0 w-full group">
        <select id="pad_nature_of_event_id" wire:model="pad_nature_of_event_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $pad_nature_of_event->id ?? '' }}">{{ $pad_nature_of_event->id ?? 'Natureza do Evento' }}</option>
            @foreach ($pad_nature_of_events as $pad_nature_of_event)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $pad_nature_of_event->id ?? '' }}" @selected(old('pad_nature_of_event_id') ==  $pad_nature_of_event->id)>{{$pad_nature_of_event->pad_nature_of_event }}</option>
            @endforeach
        </select>
        <x-input-error for="pad_nature_of_event_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="pad_status_id" wire:model="pad_status_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $pad_status->id ?? '' }}">{{ $pad_status->id ?? 'Status' }}</option>
            @foreach ($pad_statuses as $pad_status)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $pad_status->id ?? '' }}" @selected(old('pad_status_id') ==  $pad_status->id)>{{$pad_status->pad_status }}</option>
            @endforeach
        </select>
        <x-input-error for="pad_status_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="pad_local_id" wire:model="pad_local_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $pad_local->id ?? '' }}">{{ $pad_local->id ?? 'Local do Evento' }}</option>
            @foreach ($pad_locals as $pad_local)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $pad_local->id ?? '' }}" @selected(old('pad_local_id') ==  $pad_local->id)>{{$pad_local->pad_local }}</option>
            @endforeach
        </select>
        <x-input-error for="pad_local_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select id="pad_event_type_id" wire:model="pad_event_type_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $pad_event_type->id ?? '' }}">{{ $pad_event_type->id ?? 'Tipo de Evento' }}</option>
            @foreach ($pad_event_types as $pad_event_type)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $pad_event_type->id ?? '' }}" @selected(old('pad_event_type_id') ==  $pad_event_type->id)>{{$pad_event_type->pad_event_type }}</option>
            @endforeach
        </select>
        <x-input-error for="pad_event_type_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>
{{-- linha3 --}}
<div class="relative z-0 w-full group mt-4">
    <label for="remark" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
    <textarea id="remark" wire:model="remark" rows="6"
        class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Observações">{{ old('remark', $remark ?? '') }}</textarea>
</div>