<div>
    <div class="my-12">
        @include('livewire.report.prison.includes.fields')
    </div>
    <div class="flex justify-center mb-12">
        <x-blue-button wire:click='clearFieldes' class="ml-4 bg-red-600">{{ 'Limpar Filtros de Pesquisa' }} </x-blue-button>
    </div>
    <div class="p-2">
        {{-- Formulário para pdf --}}
        <form action="{{ route('infopen.prisons.pdf') }}" method="post" target="_blank">
            @csrf
            <input type="hidden" name="type_search" value="{{ $type_search }}">
            <input type="hidden" name="prison_origin_id" value="{{ $prison_origin_id }}">
            <input type="hidden" name="output_type_id" value="{{ $output_type_id }}">
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">
            
            {{-- Gerar PDF --}}
            <div class="flex justify-end mb-4">
                <x-blue-button class="bg-blue-600">{{ 'Gerar PDF' }} </x-blue-button>
            </div>
        </form>

        @include('livewire.report.prison.includes.table')
    </div>

    {{-- paginação --}}
    <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
        {{ $prisons->onEachSide(1)->links() }}
    </div>
</div>
