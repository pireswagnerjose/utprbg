<div>
    <div
        class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        <div class="flex mb-4">
            <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">Lista de Presos</h2>
        </div>

        {{-- Formulário --}}
        <form method="any" action="{{ route('vcam-list.pdf') }}" target="_blank">
            @csrf

            {{-- linha 1 --}}
            <div class="grid md:grid-cols-2 md:gap-6 mt-16 mb-6">
                <div class="col-span-1 relative z-0 w-full group">
                    <x-input type="date" name="start_date" />
                    <x-label for="start_date" name="start_date" value="{{ 'Data Inicial' }}" />
                </div>
                <div class="col-span-1 relative z-0 w-full group">
                    <x-input type="date" name="end_date" />
                    <x-label for="end_date" name="end_date" value="{{ 'Data Final' }}" />
                </div>
            </div>

            {{-- botão pesquisar --}}
            <div class="flex justify-end">
                <x-blue-button class="ml-4">{{ 'Pesquisar' }} </x-blue-button>
            </div>
        </form>

    </div>
</div>