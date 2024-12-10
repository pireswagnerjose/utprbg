<div>
    <div class="mb-12">
        @include('livewire.report.education-level.includes.fields')
    </div>
    <div class="flex justify-center mb-12">
        <x-blue-button wire:click='clearFieldes' class="ml-4 bg-red-600">{{ 'Limpar Filtros de Pesquisa' }} </x-blue-button>
    </div>
    <div class="p-8">
        {{-- Formulário para pdf --}}
        <form action="{{ route('infopen.prisons.pdf') }}" method="any" target="_blank">
            @csrf
            <input type="hidden" name="education_level_id" value="{{ $education_level_id }}">
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">
            {{-- Gerar PDF --}}
            <div class="flex justify-end mb-6">
                <x-blue-button class="ml-4 bg-blue-600">{{ 'Gerar PDF' }} </x-blue-button>
            </div>
        </form>
        @include('livewire.report.education-level.includes.table')
    </div>

    {{-- paginação --}}
    <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
        {{ $prisons->onEachSide(1)->links() }}
    </div>
</div>
