<div
    class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

    <div class="flex mb-4">
        <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">Tipos Penais</h2>
    </div>

    {{-- Search --}}

    <div class="grid md:grid-cols-1 md:gap-6 mt-16 mb-6">
        <div class="relative z-0 w-full group">
            <select wire:model="penal_type_id" wire:change='penal_type_fun'
                class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600" selected value="">Selecione a lei</option>
                @foreach ($penal_types as $penal_type)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $penal_type->id }}">
                        {{ $penal_type->law }} - {{ $penal_type->article }} - {{ $penal_type->paragraph }} - {{ $penal_type->item }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @if (isset($prisoners))
        <div class="
            mx-auto mt-6 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800
            overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100
        ">
            {{-- paginação --}}
            <div class="
                pl-2 py-4 mb-4 text-zinc-50 dark:text-zinc-400
                border-b border-blue-300 dark:border-blue-500 pb-3
            ">
                {{ $prisoners->onEachSide(1)->links() }}
            </div>
            @include('livewire.infopen.criminal-types.includes.search-card')
        </div>
    @endif
</div>
