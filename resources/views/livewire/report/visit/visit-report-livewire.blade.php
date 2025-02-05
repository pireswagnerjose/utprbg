<x-app-layout>
    <div class="w-full text-center">
        @if (session('success'))
        <span class="text-green-500 text-sm">{{ session('success') }}</span>
        @endif
        @if (session('error'))
        <span class="text-red-500 text-sm">{{ session('error') }}</span>
        @endif
    </div>
    <div class="mb-12">
        <form action="{{ route('visit-report.index') }}" method="any">
            @csrf
            @include('livewire.report.visit.includes.fields')
            <div class="flex justify-center mt-12">
                <x-blue-button wire:click='clearFieldes' class="ml-4 bg-green-600">{{ 'Pesquisar' }}
                </x-blue-button>
                <x-blue-button wire:click='clearFieldes' class="ml-4 bg-red-600">{{ 'Limpar Pesquisa' }}
                </x-blue-button>
            </div>
        </form>
    </div>
    <div class="p-8">
        {{-- Formulário para pdf --}}
        <form action="{{ route('visit.pdf') }}" method="any" target="_blank">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">
            {{-- Gerar PDF --}}
            <div class="flex justify-end mb-6">
                <x-blue-button class="ml-4 bg-blue-600">{{ 'Gerar PDF' }} </x-blue-button>
            </div>
        </form>
        @include('livewire.report.visit.includes.table')
    </div>

    {{-- paginação --}}
    <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
        {{ $visit_schedulings->links(data: ['scrollTo' => false]) }}
    </div>
</x-app-layout>