{{-- linha1 --}}
<div class="grid md:grid-cols-5 md:gap-6 mt-8">
    <div class="col-span-1 relative z-0 w-full group">
        <select id="degree_of_kinship_id" wire:model="degree_of_kinship_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $degree_of_kinship->id ?? '' }}">{{ $degree_of_kinship->id ?? 'Grau de Parentesco' }}</option>
            @foreach ($degree_of_kinships as $degree_of_kinship)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $degree_of_kinship->id ?? '' }}" @selected(old('degree_of_kinship_id') ==  $degree_of_kinship->id)>{{$degree_of_kinship->degree_of_kinship }}</option>
            @endforeach
        </select>
        <x-input-error for="degree_of_kinship_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-2 relative z-0 w-full group">
        <x-input type="text" wire:model="name" id="name" />
        <x-label for="name" wire:model="name" value="{{ 'Nome' }}" />
        <x-input-error for="name" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-2 relative z-0 w-full group">
        <x-input type="text" wire:model="contact" id="contact" />
        <x-label for="contact" wire:model="contact" value="{{ 'Contato' }}" />
        <x-input-error for="contact" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
    <div class="col-span-1 relative z-0 w-full group" hidden>
        <select id="status" wire:model="status" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="INATIVO">Status (ativo ou inativo)</option>
        </select>
        <x-input-error for="status" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha2 --}}
<div class="relative z-0 w-full group mt-4">
    <label for="remark" class="block mb-2 text-sm font-medium text-zinc-500 dark:text-zinc-400">Observações</label>
    <textarea id="remark" wire:model="remark" rows="6"
        class="block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400 text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Observações">{{ old('remark', $remark ?? '') }}</textarea>
</div>