<div>
    <button wire:click="addNew"><span class="text-blue-600 mr-4">[ Adicionar ]</span></button>
    {{-- create --}}
    @if($add_new == true)
        <div id="search-box" class="flex flex-col items-center px-2 my-4 justify-center w-full border-b border-blue-300 dark:border-blue-500 pb-3">
            <div class="flex justify-center items-center w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input wire:model.live.debounce.500ms='search' type="text" placeholder="Search..." class="w-2/6 text-zinc-600 dark:text-zinc-300 bg-zinc-300 hover:bg-zinc-200 dark:bg-zinc-600 dark:hover:bg-zinc-500 ml-2 border-none rounded px-4 py-2" />
            </div>
        </div>

        @include('livewire.main.process.includes.penal-type-create')
        
    @endif
    <div class="">
        <div class="grid grid-cols-1 p-2 rounded-lg">
            @foreach ($process->penal_type as $penal_type)
                <div class="border-b dark:border-zinc-700 py-2 flex justify-between">
                    <div class="text-sm uppercase items-center font-medium w-11/12">
                        - {{ $penal_type->law }} {{ $penal_type->article }} {{ $penal_type->paragraph }} {{ $penal_type->item }} <span class="font-light text-xs"> - {{ $penal_type->description }}</span>
                    </div>
                    <div class="w-1/12 text-end">
                        <button wire:click="modalProcessPenealTypeDelete({{ $penal_type->id }})"><span class="text-red-600 text-xs">[ excluir ]</span></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- @include("livewire.main.process.includes.penal-type-modal-create") --}}
    @include("livewire.main.process.includes.penal-type-modal-delete")

</div>