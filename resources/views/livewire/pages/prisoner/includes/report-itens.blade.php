<div class="p-6 text-center w-full">
    <svg class="mx-auto mb-4 text-zinc-400 w-12 h-12 dark:text-zinc-200" aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    @can('guest')
        <h3 class="mb-10 text-lg font-normal text-zinc-500 dark:text-zinc-400">
            Selecione os itens que deseja exibir no relatório!
        </h3>
    @endcan
    <form action="{{ route('prisoner-report', ['prisoner_id' => $prisoner_id]) }}" method="POST" class="w-full"
        target="_blank">
        @csrf
        @can('guest')
            <div class="grid grid-cols-2">
                <div class="flex mb-4 items-center">
                    <x-checkbox name="prisons" value="prisons" class="w-6 h-6" />
                    <label for="prisons" class="ms-2 text-sm font-medium text-zinc-900 dark:text-zinc-300">Histórico de
                        Prisões</label>
                </div>
                <div class="flex mb-4 items-center">
                    <x-checkbox name="processes" value="processes" class="w-6 h-6" />
                    <label for="processes"
                        class="ms-2 text-sm font-medium text-zinc-900 dark:text-zinc-300">Processos</label>
                </div>
                <div class="flex mb-4 items-center">
                    <x-checkbox name="photos" value="photos" class="w-6 h-6" />
                    <label for="photos" class="ms-2 text-sm font-medium text-zinc-900 dark:text-zinc-300">Fotos</label>
                </div>
                <div class="flex mb-4 items-center">
                    <x-checkbox name="addresses" value="addresses" class="w-6 h-6" />
                    <label for="addresses"
                        class="ms-2 text-sm font-medium text-zinc-900 dark:text-zinc-300">Endereços</label>
                </div>
                <div class="flex mb-4 items-center">
                    <x-checkbox name="internal_services" value="internal_services" class="w-6 h-6" />
                    <label for="internal_services"
                        class="ms-2 text-sm font-medium text-zinc-900 dark:text-zinc-300">Atendimentos
                        Internos</label>
                </div>
                <div class="flex mb-4 items-center">
                    <x-checkbox name="legal_assistances" value="legal_assistances" class="w-6 h-6" />
                    <label for="legal_assistances"
                        class="ms-2 text-sm font-medium text-zinc-900 dark:text-zinc-300">Atendimentos
                        Jurídicos</label>
                </div>
                <div class="flex mb-4 items-center">
                    <x-checkbox name="external_exits" value="external_exits" class="w-6 h-6" />
                    <label for="external_exits" class="ms-2 text-sm font-medium text-zinc-900 dark:text-zinc-300">Saídas
                        Externas</label>
                </div>
                <div class="flex mb-4 items-center">
                    <x-checkbox name="families" value="families" class="w-6 h-6" />
                    <label for="families"
                        class="ms-2 text-sm font-medium text-zinc-900 dark:text-zinc-300">Familiares</label>
                </div>
            </div>
        @endcan
        <div class="mt-6">
            <button wire:click="closeModalReport" type='button'
                class='inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 transition ease-in-out duration-150'>
                {{ __('Close') }}
            </button>
            <x-blue-button class="ms-3">
                {{ 'Exibir Relatório!' }}
            </x-blue-button>
        </div>
    </form>
</div>
