<div class="py-1 mx-4">
    <div class="mx-auto p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        <div class="flex justify-end mb-5">
            {{-- Título da Página --}}
            <x-title-page>Dados do Preso</x-title-page>

            {{-- botões --}}
            <div class="grid grid-cols-3 gap-2 px-2 justify-items-end">
                {{-- chama o modal para exclusão do item --}}
                <div class="group grid justify-items-center w-16 border-b border-zinc-200 dark:border-zinc-600">
                    <button type="button" wire:click="modalPrisonerDelete({{ $prisoner->id }})" class="w-8 h-8 bg-red-600 dark:bg-red-500 rounded-full p-2">
                        <svg class="w-4 h-4 text-red-50 dark:text-red-50 hover:text-red-400 hover:dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 8h6m-9-3.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                        </svg>
                    </button>
                    <span class="text-xs text-zinc-600 dark:text-zinc-400">Excluir</span>
                </div>

                {{-- Editar --}}
                <div class="group grid justify-items-center w-16 border-b border-zinc-200 dark:border-zinc-600">
                    <button wire:click="modalPrisonerUpdate({{ $prisoner->id }})" class="w-8 h-8 bg-blue-600 dark:bg-blue-500 rounded-full p-2">
                        <svg class=" w-4 h-4 text-blue-50 dark:text-blue-50 hover:text-blue-400 hover:dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.109 17H1v-2a4 4 0 0 1 4-4h.87M10 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm7.95 2.55a2 2 0 0 1 0 2.829l-6.364 6.364-3.536.707.707-3.536 6.364-6.364a2 2 0 0 1 2.829 0Z" />
                        </svg>
                    </button>
                    <span class="text-xs text-zinc-600 dark:text-zinc-400">Editar</span>
                </div>

                {{-- Relatório PDF --}}
                <div class="group grid justify-items-center w-16 border-b border-zinc-200 dark:border-zinc-600">
                    <button wire:click="modalReport({{ $prisoner->id }})" class="w-8 h-8 bg-green-600 dark:bg-green-500 rounded-full p-2">
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

                @include('livewire.main.prisoner.includes.profile-photo')

                <livewire:main.prisoner.prisoner-unit-address-livewire :prisoner_id="$prisoner->id" />
                
            </div>
            <div class="w-full col-span-10">
                {{-- linha 1 --}}
                <div class="grid grid-cols-4 gap-4 mb-5">
                    <div class="pl-3 col-span-2">
                        <div class="font-light text-sm text-zinc-500">Nome</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->name }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">vulgo</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->nickname }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Data Nasc.</div>
                        @empty(!$prisoner->date_birth)
                            <div class="text-base font-medium uppercase">{{ \Carbon\Carbon::parse($prisoner->date_birth)->format('d/m/Y') }}</div>
                        @endempty
                    </div>
                </div>
                {{-- linha 2 --}}
                <div class="grid grid-cols-4 gap-4 mb-5">
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">CPF</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->cpf }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">RG</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->rg }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Título Eleitor</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->title }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Certidão Nascimento</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->birth_certificate }}</div>
                    </div>
                </div>
                {{-- linha 3 --}}
                <div class="grid grid-cols-5 gap-4 mb-5">
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Reservista</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->reservist }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Cartão Sus</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->sus_card }}</div>
                    </div>
                     <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">RJI</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->rji }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Etnia</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->ethnicity->ethnicity }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Orientação Sexual</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->sexual_orientation->sexual_orientation }}</div>
                    </div>
                </div>
                {{-- linha 4 --}}
                <div class="grid grid-cols-2 gap-4 mb-5">
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Mãe</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->mother }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Pai</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->father }}</div>
                    </div>
                </div>
                {{-- linha 5 --}}
                <div class="grid grid-cols-5 gap-4 mb-5">
                    <div class="pl-3 col-span-2">
                        <div class="font-light text-sm text-zinc-500">Escolaridade</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->education_level->education_level }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Estado Civil</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->civil_status->civil_status }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Sexo</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->sex->sex }}</div>
                    </div>
                    <div class="">
                        <div class="font-light text-sm text-zinc-500">Status da Prisão</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->status_prison->status_prison }}</div>
                    </div>
                </div>
                {{-- linha 6 --}}
                <div class="grid grid-cols-4 gap-4 mb-5">
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Profissão</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->profession }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Naturalidade</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->municipality->municipality }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">UF</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->state->state }}</div>
                    </div>
                    <div class="pl-3">
                        <div class="font-light text-sm text-zinc-500">Nacionalidade</div>
                        <div class="text-base font-medium uppercase">{{ $prisoner->country->country }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('livewire.main.prisoner.includes.tabs')