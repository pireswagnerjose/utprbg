<div>
    <div
        class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        <div class="flex mb-4">
            <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">Lista de Presos</h2>
        </div>

        @include('livewire.report.prisoner-list.include.fields')
        {{-- Formulário --}}
        <form method="any" action="{{ route('prisoner-list.pdf') }}" target="_blank">
            @csrf
            <input type="hidden" name="c_s_photo" value="{{ $c_s_photo }}">
            <input type="hidden" name="ward_id" value="{{ $ward_id }}">
            <input type="hidden" name="list_type" value="{{ $list_type }}">

            {{-- botão pesquisar --}}
            <div class="flex justify-end my-4">
                <x-blue-button class="ml-4">{{ 'GERAR PDF' }} </x-blue-button>
            </div>
        </form>
        @if ($this->list_type == 'list')
            @include('livewire.report.prisoner-list.include.table')
            <!-- Paginação -->
            <div
                class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
                {{ $unit_adds->onEachSide(1)->links() }}
            </div>
            <!-- end Paginação -->
        @endif

        @if ($this->list_type == 'conference')
            @include('livewire.report.prisoner-list.include.table-conference')
            <!-- Paginação -->
            <div
                class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
                {{-- {{ $unit_adds->onEachSide(1)->links() }} --}}
            </div>
            <!-- end Paginação -->
        @endif
    </div>
</div>
