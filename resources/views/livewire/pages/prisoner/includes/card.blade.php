<div class="mb-1 px-6">
    {{-- botões --}}
    <div class="flex justify-end gap-2 my-2">
        {{-- chama o modal para exclusão do item --}}
        @can('admin')
            <div class="group grid justify-items-center w-12 border-b border-zinc-200 dark:border-zinc-600">
                <button type="button" wire:confirm="Tem certeza que deseja excluir o Preso" wire:click="delete({{ $prisoner_show->id }})"
                    class="w-6 h-6 bg-red-600 dark:bg-red-500 rounded-full p-1">
                    <svg class="w-4 h-4 text-red-50 dark:text-red-50 hover:text-red-400 hover:dark:text-red-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 8h6m-9-3.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                    </svg>
                </button>
                <span class="text-xs text-zinc-600 dark:text-zinc-400">Excluir</span>
            </div> 
        @endcan
        
        {{-- Editar --}}
        @can('admin-cartorio_admin') 
            <div class="group grid justify-items-center w-12 border-b border-zinc-200 dark:border-zinc-600">
                <button wire:click="modal({{ $prisoner_show->id }})" class="w-6 h-6 bg-blue-600 dark:bg-blue-500 rounded-full p-1">
                    <svg class=" w-4 h-4 text-blue-50 dark:text-blue-50 hover:text-blue-400 hover:dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.109 17H1v-2a4 4 0 0 1 4-4h.87M10 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm7.95 2.55a2 2 0 0 1 0 2.829l-6.364 6.364-3.536.707.707-3.536 6.364-6.364a2 2 0 0 1 2.829 0Z" />
                    </svg>
                </button>
                <span class="text-xs text-zinc-600 dark:text-zinc-400">Editar</span>
            </div>
        @endcan

        {{-- Relatório PDF --}}
        <div class="group grid justify-items-center w-12 border-b border-zinc-200 dark:border-zinc-600">
            <button wire:click="modalReport({{ $prisoner_show->id }})" class="w-6 h-6 bg-green-600 dark:bg-green-500 rounded-full p-1">
                <svg class="w-4 h-4 text-green-50 dark:text-green-50 hover:text-green-400 hover:dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9v-5h1.5a1.5 1.5 0 1 1 0 3H1m12 2v-5h2m-2 3h2m-8-3v5h1.375A1.626 1.626 0 0 0 10 13.375v-1.75A1.626 1.626 0 0 0 8.375 10H7Z"/>
                </svg>
            </button>
            <span class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">PDF</span>
        </div>
    </div>


    {{-- Conteúdo da Página --}}
    <div class="grid md:grid-cols-12 gap-4 mb-5">
        
        {{-- Foto e Localização --}}
        <div class="md:col-span-2 w-full">

            {{-- Foto do Perfil --}}
            @include('livewire.pages.prisoner.includes.profile-photo')

            {{-- Localização na Unidade --}}
            <div class="mt-4 text-center">
                @if (!empty( $prisoner_show->unit_address))
                    @foreach ( $prisoner_show->unit_address as $unit_address)
                        @if ($unit_address->status == "ATIVO")
                            <dd class="font-normal text-xs">ALA / CELA</dd>
                            <dd class="text-sm font-semibold uppercase">{{ $unit_address->cell->cell }}</dd>
                        @endif
                    @endforeach
                @endif
            </div>
            @can('admin-cartorio_admin-cartorio_user')
                <livewire:pages.unit-address.unit-address-livewire :prisoner_id="$prisoner_show->id" />
            @endcan
            
            
        </div>
        <div class="md:col-span-10 w-full">
            {{-- linha 1 --}}
            <div class="grid md:grid-cols-4 gap-4 mb-5">
                <div class="md:col-span-2 w-full">
                    <x-item-topic>Nome</x-item-topic>
                    <x-item-data>{{ $prisoner_show->name }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>vulgo</x-item-topic>
                    <x-item-data>{{ $prisoner_show->nickname }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Data Nasc.</x-item-topic>
                    @empty(!$prisoner_show->date_birth)
                        <x-item-data>{{ \Carbon\Carbon::parse($prisoner_show->date_birth)->format('d/m/Y') }}</x-item-data>
                    @endempty
                </div>
            </div>
            {{-- linha 2 --}}
            <div class="grid md:grid-cols-4 gap-4 mb-5">
                <div class="md:col-span-1 w-full">
                    <x-item-topic>CPF</x-item-topic>
                    <x-item-data>{{ $prisoner_show->cpf }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>RG</x-item-topic>
                    <x-item-data>{{ $prisoner_show->rg }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Título Eleitor</x-item-topic>
                    <x-item-data>{{ $prisoner_show->title }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Certidão Nascimento</x-item-topic>
                    <x-item-data>{{ $prisoner_show->birth_certificate }}</x-item-data>
                </div>
            </div>
            {{-- linha 3 --}}
            <div class="grid md:grid-cols-5 gap-4 mb-5">
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Reservista</x-item-topic>
                    <x-item-data>{{ $prisoner_show->reservist }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Cartão Sus</x-item-topic>
                    <x-item-data>{{ $prisoner_show->sus_card }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>RJI</x-item-topic>
                    <x-item-data>{{ $prisoner_show->rji }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Etnia</x-item-topic>
                    <x-item-data>{{ $prisoner_show->ethnicity->ethnicity }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Orientação Sexual</x-item-topic>
                    <x-item-data>{{ $prisoner_show->sexual_orientation->sexual_orientation }}</x-item-data>
                </div>
            </div>
            {{-- linha 4 --}}
            <div class="grid md:grid-cols-2 gap-4 mb-5">
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Mãe</x-item-topic>
                    <x-item-data>{{ $prisoner_show->mother }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Pai</x-item-topic>
                    <x-item-data>{{ $prisoner_show->father }}</x-item-data>
                </div>
            </div>
            {{-- linha 5 --}}
            <div class="grid md:grid-cols-5 gap-4 mb-5">
                <div class="md:col-span-2 w-full">
                    <x-item-topic>Escolaridade</x-item-topic>
                    <x-item-data>{{ $prisoner_show->education_level->education_level }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Estado Civil</x-item-topic>
                    <x-item-data>{{ $prisoner_show->civil_status->civil_status }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Sexo</x-item-topic>
                    <x-item-data>{{ $prisoner_show->sex->sex }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Status da Prisão</x-item-topic>
                    <x-item-data>{{ $prisoner_show->status_prison->status_prison }}</x-item-data>
                </div>
            </div>
            {{-- linha 6 --}}
            <div class="grid md:grid-cols-4 gap-4 mb-5">
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Profissão</x-item-topic>
                    <x-item-data>{{ $prisoner_show->profession }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Naturalidade</x-item-topic>
                    <x-item-data>{{ $prisoner_show->municipality->municipality }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>UF</x-item-topic>
                    <x-item-data>{{ $prisoner_show->state->state }}</x-item-data>
                </div>
                <div class="md:col-span-1 w-full">
                    <x-item-topic>Nacionalidade</x-item-topic>
                    <x-item-data>{{ $prisoner_show->country->country }}</x-item-data>
                </div>
            </div>
            {{-- linha 7 --}}
            <div class="w-full">
                <x-item-topic>Informações Complementares</x-item-topic>
                <x-item-data>{{ $prisoner_show->remarks }}</x-item-data>
            </div>
        </div>
    </div>
</div>