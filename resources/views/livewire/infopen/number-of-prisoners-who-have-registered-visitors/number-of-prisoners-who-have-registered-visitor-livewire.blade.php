<div>
    <div class="mb-12 flex flex-col items-center">
        <div class="grid md:grid-cols-1 md:gap-6 mt-16 mb-6 w-1/2">
            <div class="col-span-1 relative z-0 w-full group">
                <x-input type="date" wire:model.live.debounce.500ms="date" required />
                <x-label for="date" name="date" value="{{ 'Data' }}" />
            </div>
        </div>
        <div class="flex justify-center mb-12">
            <x-blue-button wire:click='clearFields' class="ml-4 bg-red-600">{{ 'Limpar Filtros de Pesquisa' }}
            </x-blue-button>
        </div>
    </div>

    @include('livewire.infopen.number-of-prisoners-who-have-registered-visitors.includes.table')


    {{-- paginação --}}
    <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
        {{ $prisoners->onEachSide(1)->links() }}
    </div>
</div>
