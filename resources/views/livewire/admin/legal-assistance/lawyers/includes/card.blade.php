{{-- Conteúdo da Página --}}
<div class="flex justify-center mt-4">
    <div class="odd:bg-zinc-200 even:bg-zinc-600"></div>
    <div
        class="w-full flex items-end justify-center space-y-6 hover:bg-zinc-200 dark:hover:bg-zinc-700 border-b border-zinc-200 dark:border-zinc-700">
        <div class="w-full grid grid-cols-9 gap-4">
            <div class="col-span-2">
                <a title='{{ $lawyer->lawyer }}' href='{{ asset("storage/$lawyer->photo") }}' rel='shadowbox[galeria]'>
                    <img class="h-36 w-full rounded-l-lg" src='{{ asset("storage/$lawyer->photo") }}'
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
                    <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">
                        Preso(s) atendido(s) pelo advogado:
                    </span>
                    <div class="grid grid-cols-2 gap-x-4 text-sm text-blue-700">
                        @php
                            $assistance_with_lawyers = App\Models\Main\AssistanceWithLawyer::where(
                                'lawyer_id',
                                $lawyer->id,
                            )->get();
                            foreach ($assistance_with_lawyers as $assistance_with_lawyer) {
                                $prisoners_id[] = $assistance_with_lawyer->prisoner_id;
                            }
                            if (!empty($prisoners_id)) {
                                $prisonersId = array_unique($prisoners_id, SORT_REGULAR);
                                $prisoners = App\Models\Main\Prisoner::whereIn('id', $prisonersId)->get();
                            }

                        @endphp
                        @if (isset($prisoners) && $prisoners->isNotEmpty())
                            @foreach ($prisoners as $prisoner)
                                <a class="text-blue-700" href="{{ route('prisoners.show', $prisoner->id) }}">
                                    <p>{{ $prisoner->name }}</p>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="w-full uppercase mt-4">
                    <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Observação: </span>
                    <p>{{ $lawyer->remark }}</p>
                </div>
            </div>
        </div>
        {{-- botões --}}
        <div class="flex space-x-8 items-center pb-2">
            <button wire:click="modalUpdate({{ $lawyer->id }})"
                class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
                <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
            </button>

            <button type="button" wire:confirm="Tem certeza que deseja excluir o Preso"
                wire:click="modalDelete({{ $lawyer->id }})"
                class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
                <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
            </button>
        </div>
    </div>
</div>
