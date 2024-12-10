<div>
    <div
        class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        <div class="flex mb-4">
            <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">VCAM</h2>
        </div>

        <div class="mb-12 flex flex-col items-center">
            @include('livewire.report.vcam.includes.fields')
            <div class="text-center">
                <p class="font-bold text-blue-700 text-lg">Digite a data inicial e a data final para gerar o relatório em PDF</p>
            </div>
        </div>

        @if (!empty($start_date) && !empty($end_date))
        {{-- Formulário PDF --}}
        <form action="{{ route('vcam-list.pdf') }}" method="any" target="_blank">
            @csrf
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">

            {{-- Gerar PDF --}}
            <div class="flex justify-end mb-2">
                <x-blue-button class="ml-4 bg-blue-600">{{ 'Gerar PDF' }} </x-blue-button>
            </div>
        </form>

        {{-- Formulário Excel --}}
        <form action="{{ route('vcam-list.csv') }}" method="any" target="_blank">
            @csrf
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">

            {{-- Gerar PDF --}}
            <div class="flex justify-end mb-6">
                <x-blue-button class="ml-4 bg-green-600">{{ 'Gerar EXCEL' }} </x-blue-button>
            </div>
        </form>
        
        @include('livewire.report.vcam.includes.table')
    </div>

    {{-- paginação --}}
    <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
        {{ $prisons->onEachSide(1)->links() }}
    </div>
    @endif
</div>