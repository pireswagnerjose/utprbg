{{-- linha 1 --}}
<div class="grid md:grid-cols-6 md:gap-8 mb-8 mt-12">
    <div class="col-span-2 relative z-0 w-full group">
        <x-item-topic>Nome do Visitante</x-item-topic>
        <x-item-data>{{ $visitScheduling_visitant_name }}</x-item-data>
    </div>
    <div class="col-span-2 relative z-0 w-full group">
        <x-item-topic>Nome do Preso</x-item-topic>
        <x-item-data>{{ $visitScheduling_prisoner_name }}</x-item-data>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <x-item-topic>Data da Visita</x-item-topic>
        <x-item-data>{{ \Carbon\Carbon::parse($visitScheduling_date_visit)->format('d/m/Y') }}</x-item-data>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select wire:model="visitScheduling_status"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">Status</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="1">MANTIDA</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="0">CANCELADA</option>
        </select>
        <x-input-error for="status" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>

{{-- linha 7 --}}
<div class="relative z-0 w-full group">
    <textarea wire:model="visitScheduling_remark" rows="4"
        class="
                    block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md
                    bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400
                    text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Informações Complementares">
                {{ old('visitScheduling_remark', $visitScheduling_remark ?? '') }}
            </textarea>
</div>
