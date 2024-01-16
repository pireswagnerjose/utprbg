@foreach ($penal_types as $penalType)
    {{-- Conteúdo da Página --}}
    <div class="flex justify-center">
        <div class="odd:bg-zinc-200 even:bg-zinc-600"></div>
        <div class="w-full flex items-end justify-center space-y-6 hover:bg-zinc-200 dark:hover:bg-zinc-700 border-b border-zinc-200 dark:border-zinc-700">
            <div class="w-full flex justify-between items-center">
                <div class="grid grid-cols-10 py-2 text-sm font-semibold uppercase w-full pr-4">
                    <div class="col-span-1">
                        <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Tipo Penal: </span>
                        <p>{{ $penalType->law }}</p>
                    </div>
                    <div class="col-span-1">
                        <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Tipo Penal: </span>
                        <p>{{ $penalType->article }}</p>
                    </div>
                    <div class="col-span-1">
                        <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Tipo Penal: </span>
                        <p>{{ $penalType->paragraph }}</p>
                    </div>
                    <div class="col-span-1">
                        <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Tipo Penal: </span>
                        <p>{{ $penalType->item }}</p>
                    </div>
                    <div class="col-span-6 mb-1">
                        <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Tipo Penal: </span>
                        <p class="text-xs font-light text-justify">{{ $penalType->description }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <button wire:click="processPenealTypeCreate({{ $penalType->id }})" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                        Adicionar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach
{{-- paginação --}}
<div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
    {{ $penal_types->onEachSide(1)->links() }}
</div>
