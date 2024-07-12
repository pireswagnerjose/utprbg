<div
    class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

    <div class="flex mb-4">
        <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">Atestado de Pena</h2>
    </div>

    {{-- Search --}}

    <div class="grid md:grid-cols-2 md:gap-6 mt-16 mb-6">
        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="date" wire:model.live.debounce.500ms="start_date" />
            <x-label for="start_date" value="{{ 'Data Inicial' }}" />
        </div>
        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="date" wire:model.live.debounce.500ms="end_date" required />
            <x-label for="end_date" value="{{ 'Data Final' }}" />
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
            @include('livewire.infopen.certificate-of-sentence.includes.search-card')
        </div>
    @endif
</div>