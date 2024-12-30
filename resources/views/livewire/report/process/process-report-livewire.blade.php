<div>
    <div class="my-12">
        @include('livewire.report.process.includes.fields')
    </div>
    <div class="flex justify-center mb-12">
        <x-blue-button wire:click='clearFieldes' class="ml-4 bg-red-600">{{ 'Limpar Filtros de Pesquisa' }}
        </x-blue-button>
    </div>
    <div class="p-2">
        {{-- Formulário para pdf --}}
        <form action="{{ route('infopen.processes.pdf') }}" method="post" target="_blank">
            @csrf
            <input type="hidden" name="origin_process_id" value="{{ $origin_process_id }}">
            <input type="hidden" name="process_regime_id" value="{{ $process_regime_id }}">

            {{-- Gerar PDF --}}
            <div class="flex justify-end mb-4">
                <x-blue-button class="bg-blue-600">{{ 'Gerar PDF' }} </x-blue-button>
            </div>
        </form>

        @include('livewire.report.process.includes.table')
    </div>

    {{-- paginação --}}
    <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
        {{ $processes->onEachSide(1)->links() }}
    </div>
</div>