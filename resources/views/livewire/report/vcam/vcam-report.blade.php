<div>
    <div
        class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        <div class="flex mb-4">
            <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">VCAM</h2>
        </div>

        {{-- Formulário --}}
        <form action="{{ route('vcam-list.csv') }}" method="any" target="_blank">
            @csrf

            {{-- linha 1 --}}
            <div class="grid md:grid-cols-3 md:gap-6 mt-16 mb-6">
                <div class="col-span-1 relative z-0 w-full group">
                    <x-input type="date" name="start_date" required />
                    <x-label for="start_date" name="start_date" value="{{ 'Data Inicial' }}" />
                </div>
                <div class="col-span-1 relative z-0 w-full group">
                    <x-input type="date" name="end_date" required />
                    <x-label for="end_date" name="end_date" value="{{ 'Data Final' }}" />
                </div>
                {{-- <div class="col-span-1 relative z-0 w-full group">
                    <x-input type="text" name="value_thirty_days" required />
                    <x-label for="value_thirty_days" name="value_thirty_days" value="{{ 'Valor Diária 30 dias' }}" />
                </div>
                <div class="col-span-1 relative z-0 w-full group">
                    <x-input type="text" name="value_thirty_one_days" required />
                    <x-label for="value_thirty_one_days" name="value_thirty_one_days" value="{{ 'Valor Diária 31 dias' }}" />
                </div> --}}
                <div class="col-span-1 relative z-0 w-full group">
                    <x-input type="text" name="value_month" required />
                    <x-label for="value_month" name="value_month" value="{{ 'Valor Mensal' }}" />
                </div>
            </div>

            {{-- botões --}}
            <div class="flex justify-end">
                <x-blue-button class="ml-4 bg-green-600">{{ 'Gerar EXCEL' }} </x-blue-button>
            </div>
        </form>

    </div>
</div>