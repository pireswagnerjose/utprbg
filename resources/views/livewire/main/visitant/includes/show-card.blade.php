<div class="py-1 mx-4">
    <div class="mx-auto p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        <div class="flex justify-end mb-5">
            {{-- Título da Página --}}
            <x-title-page>Dados do Visitante</x-title-page>

            {{-- botões --}}
            <div class="flex justify-end gap-2 px-2">
                {{-- chama o modal para exclusão do item --}}
                @can('admin')
                    <div class="group grid justify-items-center w-16 border-b border-zinc-200 dark:border-zinc-600">
                        <button type="button" wire:click="modalVisitantDelete({{ $visitant->id }})" class="w-8 h-8 bg-red-600 dark:bg-red-500 rounded-full p-2">
                            <svg class="w-4 h-4 text-red-50 dark:text-red-50 hover:text-red-400 hover:dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 8h6m-9-3.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                            </svg>
                        </button>
                        <span class="text-xs text-zinc-600 dark:text-zinc-400">Excluir</span>
                    </div> 
                @endcan

                {{-- Editar --}}
                @can('admin-cartorio_admin') 
                    <div class="group grid justify-items-center w-16 border-b border-zinc-200 dark:border-zinc-600">
                        <button wire:click="modalVisitantEdit({{ $visitant->id }})" class="w-8 h-8 bg-blue-600 dark:bg-blue-500 rounded-full p-2">
                            <svg class=" w-4 h-4 text-blue-50 dark:text-blue-50 hover:text-blue-400 hover:dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.109 17H1v-2a4 4 0 0 1 4-4h.87M10 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm7.95 2.55a2 2 0 0 1 0 2.829l-6.364 6.364-3.536.707.707-3.536 6.364-6.364a2 2 0 0 1 2.829 0Z" />
                            </svg>
                        </button>
                        <span class="text-xs text-zinc-600 dark:text-zinc-400">Editar</span>
                    </div>
                @endcan

                {{-- Relatório PDF --}}
                <div class="group grid justify-items-center w-16 border-b border-zinc-200 dark:border-zinc-600">
                    <button wire:click="modalReport({{ $visitant->id }})" class="w-8 h-8 bg-green-600 dark:bg-green-500 rounded-full p-2">
                        <svg class="w-4 h-4 text-green-50 dark:text-green-50 hover:text-green-400 hover:dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9v-5h1.5a1.5 1.5 0 1 1 0 3H1m12 2v-5h2m-2 3h2m-8-3v5h1.375A1.626 1.626 0 0 0 10 13.375v-1.75A1.626 1.626 0 0 0 8.375 10H7Z"/>
                        </svg>
                    </button>
                    <span class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">Gerar PDF</span>
                </div>
            </div>
        </div>

        {{-- Conteúdo da Página --}}
        <div class="grid grid-cols-12 gap-4 mb-5">
            {{-- foto do perfil --}}
            <div class="w-full max-h-72 col-span-2">
                <span class="flex flex-col w-full items-center">
                    <img class="object-cover h-full w-full rounded-lg" src='{{ asset("storage/$visitant->photo") }}' alt="{{ $visitant->name }}">
                </span>
            </div>

            <div class="w-full col-span-10">
                {{-- linha 1 --}}
                <div class="grid grid-cols-4 gap-4 mb-5">
                    <div class="col-span-2">
                        <x-item-topic>Nome</x-item-topic>
                        <x-item-data>{{ $visitant->name }}</x-item-data>
                    </div>
                    <div>
                        <x-item-topic>Data Nasc.</x-item-topic>
                        @empty(!$visitant->date_of_birth)
                            <x-item-data>{{ \Carbon\Carbon::parse($visitant->date_of_birth)->format('d/m/Y') }}</x-item-data>
                        @endempty
                    </div>
                    <div>
                        <x-item-topic>CPF</x-item-topic>
                        <x-item-data>{{ $visitant->cpf }}</x-item-data>
                    </div>
                </div>

                {{-- Linha 2 --}}
                <div class="grid grid-cols-4 gap-4 mb-5">
                    <div>
                        <x-item-topic>Estado Civil</x-item-topic>
                        <x-item-data>{{ $visitant->civil_status->civil_status }}</x-item-data>
                    </div>

                    <div>
                        <x-item-topic>Sexo</x-item-topic>
                        <x-item-data>{{ $visitant->sex->sex }}</x-item-data>
                    </div>

                    <div>
                        <x-item-topic>Status</x-item-topic>
                        <x-item-data>{{ $visitant->status }}</x-item-data>
                    </div>

                    <div>
                        <x-item-topic>Fone</x-item-topic>
                        <x-item-data>{{ $visitant->phone }}</x-item-data>
                    </div>
                </div>

                {{-- linha 3 --}}
                <div class="grid grid-cols-6 gap-4 mb-5">
                    <div class="col-span-3">
                        <x-item-topic>Logradouro</x-item-topic>
                        <x-item-data>{{ $visitant->street }}</x-item-data>
                    </div>

                    <div>
                        <x-item-topic>Número</x-item-topic>
                        <x-item-data>{{ $visitant->number }}</x-item-data>
                    </div>

                    <div class="col-span-2">
                        <x-item-topic>Complemento</x-item-topic>
                        <x-item-data>{{ $visitant->complement }}</x-item-data>
                    </div>
                </div>

                {{-- Linha 4 --}}
                <div class="grid grid-cols-3 gap-4 mb-5">
                    <div>
                        <x-item-topic>Bairro</x-item-topic>
                        <x-item-data>{{ $visitant->barrio }}</x-item-data>
                    </div>
                    <div>
                        <x-item-topic>Cidade</x-item-topic>
                        <x-item-data>{{ $visitant->municipality->municipality }}</x-item-data>
                    </div>
                    <div>
                        <x-item-topic>Estado</x-item-topic>
                        <x-item-data>{{ $visitant->state->state }}</x-item-data>
                    </div>
                </div>
                {{-- linha 5 --}}
                <div>
                    <x-item-topic>Informações Complementares</x-item-topic>
                    <x-item-data>{{ $visitant->remark }}</x-item-data>
                </div>
            </div>
        </div>
    </div>
</div>