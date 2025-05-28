<div class="mb-1 px-6">
    {{-- botões --}}
    <div class="flex justify-end gap-2 my-2">
        {{-- chama o modal para exclusão do item --}}
        @can('delete_lawyer')
            <div class="group grid justify-items-center w-12">
                <button type="button" wire:click="modalDelete({{ $lawyer->id }})"
                    class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
                    <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
                </button>
            </div>
        @endcan

        {{-- Editar --}}
        @can('update_lawyer')
            <div class="group grid justify-items-center w-12">
                <button wire:click="modalUpdate({{ $lawyer->id }})"
                    class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
                    <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
                </button>
            </div>
        @endcan

        {{-- Relatório PDF --}}
        @can('create_pdf_lawyer')
            <div class="group grid justify-items-center w-12">
                {{-- Relatório PDF --}}
                <form action="{{ route('lawyer.report', ['lawyer_id' => $lawyer->id]) }}" method="POST" target="_blank">
                    @csrf
                    <div class="group grid justify-items-center w-12">
                        <button
                            class="p-2 bg-green-500 dark:bg-green-400/50 hover:opacity-50 transition duration-500 rounded-full">
                            <x-lucide-file-text class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-file-text>
                        </button>
                    </div>
                </form>
            </div>
        @endcan
    </div>

    {{-- Conteúdo da Página --}}
    <div class="w-full grid grid-cols-9 gap-4 pb-10">
        <div class="col-span-2">
            <a title='{{ $lawyer->lawyer }}' href='{{ asset("storage/$lawyer->photo") }}' rel='shadowbox[galeria]'>
                <img class="h-36 w-full rounded-lg" src='{{ asset("storage/$lawyer->photo") }}'
                    alt="{{ $lawyer->lawyer }}">
            </a>
        </div>
        <div class="col-span-7">
            <div class="grid grid-cols-6 gap-6 text-base font-semibold uppercase justify-between w-full">
                <div class="col-span-3">
                    <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Advogado: </span>
                    <p>{{ $lawyer->lawyer }}</p>
                </div>
                <div class="col-span-1">
                    <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Registro: </span>
                    <p>{{ $lawyer->register }}</p>
                </div>
                <div class="col-span-2">
                    <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Contato: </span>
                    <p>{{ $lawyer->contact }}</p>
                </div>
            </div>
            <div class="w-full uppercase mt-4">
                <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Observação: </span>
                <p>{{ $lawyer->remark }}</p>
            </div>
        </div>
    </div>
    <div>
        <div class="w-full uppercase mt-4 text-center space-y-2">
            <span class="font-semibold text-xl w-full text-zinc-400 dark:text-zinc-500">
                Atendimento(s) do(a) Advogado(a):
            </span>
            <div class="">
                @include('livewire.admin.legal-assistance.lawyers.includes.table')
            </div>
        </div>
    </div>
</div>
