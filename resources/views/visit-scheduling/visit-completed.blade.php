<x-guest-layout>
    <div class="w-full mx-auto sm:w-[35%] h-screen flex items-center">
        <div class="w-full ">
            <h5 class="mb-8 text-xl text-center font-medium text-blue-900 dark:text-blue-600 uppercase">Agendamento
                realizado com sucesso!</h5>

            <div class="flex flex-col items-center">
                <span class="text-center mb-4 uppercase text-sm text-zinc-500 dark:text-zinc-400">Confira os dados
                    Abaixo:</span>

                <img class="w-24 h-24 mb-2 rounded-full shadow-lg"
                    src='{{ asset('storage/' . $visit_completed->visitant->photo) }}' alt="Bonnie image" />
                <span class="text-center text-sm text-zinc-500 dark:text-zinc-400">Nome do Visitante:</span>
                <h5 class="mb-8 text-center text-lg font-medium text-zinc-900 dark:text-white">
                    {{ $visit_completed->visitant->name }}</h5>

                <img class="w-24 h-24 mb-2 rounded-full shadow-lg"
                    src='{{ asset('storage/' . $visit_completed->prisoner->photo) }}' alt="Bonnie image" />
                <span class="text-center text-sm text-zinc-500 dark:text-zinc-400">Nome do Reeducando:</span>
                <h5 class="mb-8 text-center text-lg font-medium text-zinc-900 dark:text-white">
                    {{ $visit_completed->prisoner->name }}</h5>

                <div class="text-base uppercase text-zinc-500 dark:text-zinc-400 text-center">
                    <span>Código do Agendamento: {{ $visit_completed->id }}</span>
                    <span>Data da Visita:
                        {{ \Carbon\Carbon::parse($visit_completed->date_visit)->format('d/m/Y') }}</span>
                    <span>Tipo da Visita: {{ $visit_completed->type }}</span>
                </div>

                <div class="flex mt-4 md:mt-6">
                    <a href="{{ route('visit-scheduling.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Realizar outro Agendamento
                    </a>
                </div>
            </div>
        </div>
</x-guest-layout>
