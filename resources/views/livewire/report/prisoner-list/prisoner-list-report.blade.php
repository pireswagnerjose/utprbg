<div>
    <div
        class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        <div class="flex mb-4">
            <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">Lista de Presos</h2>
        </div>

        {{-- Formulário --}}
        <form method="any" action="{{ route('prisoner-list.pdf') }}" target="_blank">
            @csrf

            {{-- linha 1 --}}
            <div class="grid md:grid-cols-3 md:gap-6 mt-16 mb-6">
                <div class="relative z-0 w-full group mt-2">
                    <select name="status_prison_id" required
                        class="block py-0.5 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                        <option class="text-zinc-900 dark:text-zinc-600" selected value="">
                            <span>Status da Prisão</span>
                        </option>
                        @foreach ($status_prisons as $status_prison)
                            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $status_prison->id }}">
                                {{ $status_prison->status_prison }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Ala - Pavilhão --}}
                <div class="relative z-0 w-full group mt-2">
                    <select id="ward_id" name="ward_id"
                        class="block py-0.5 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                        <option class="text-zinc-900 dark:text-zinc-600" selected value="">
                            <span>Ala - Pavilhão</span>
                        </option>
                        @foreach ($wards as $ward)
                            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $ward->id }}">
                                {{ $ward->ward }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Com ou sem foto --}}
                <div class="relative z-0 w-full group mt-2">
                    <select id="c_s_photo" name="c_s_photo" required
                        class="block py-0.5 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                        <option class="text-zinc-900 dark:text-zinc-600" selected value=""><span>Com ou Sem Foto</span>
                        </option>
                        <option class="text-zinc-900 dark:text-zinc-600" value="1">Com Foto</option>
                        <option class="text-zinc-900 dark:text-zinc-600" value="2">Sem Foto</option>
                    </select>
                </div>
            </div>

            {{-- botão pesquisar --}}
            <div class="flex justify-end">
                <x-blue-button class="ml-4">{{ 'Pesquisar' }} </x-blue-button>
            </div>
        </form>

    </div>
</div>