<div
    class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

    <div class="flex mb-4">
        <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">Pena (Anos, Meses e Dias)</h2>
    </div>

    {{-- Search --}}

    <div class="grid md:grid-cols-1 md:gap-6 mt-16 mb-6">
        <div class="relative z-0 w-full group">
            <select id="sentence" wire:model="sentence" wire:change='sentence_fun'
                class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600" selected value="">Selecione o Período</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="1">Até 6 meses (inclusive)</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="2">Mais de 6 meses até 1 ano (inclusive)</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="3">Mais de 1 ano até 2 anos (inclusive)</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="4">Mais de 2 anos até 4 anos (inclusive)</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="5">Mais de 4 anos até 8 anos (inclusive)</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="6">Mais de 8 anos até 15 anos (inclusive)</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="7">Mais de 15 anos até 20 anos (inclusive)</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="8">Mais de 20 anos até 30 anos (inclusive)</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="9">Mais de 30 anos até 50 anos (inclusive)</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="10">Mais de 50 anos até 100 anos (inclusive)</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="11">Mais de 100 anos</option>
            </select>
            <x-input-error for="status_rison_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
    </div>
    @if (isset($prisoners))
        <div class="
            mx-auto mt-6 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800
            overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100
        ">
            {{-- paginação --}}
            <div class="
                pl-2 py-4 mb-4 text-zinc-50 dark:text-zinc-400
                border-b border-blue-300 dark:border-blue-500 pb-3
            ">
                {{ $prisoners->onEachSide(1)->links() }}
            </div>
            @include('livewire.infopen.sentence.includes.search-card')
        </div>
    @endif
</div>
