{{-- Conteúdo da Página --}}
<div class="flex justify-center ">
    <div class="odd:bg-zinc-200 even:bg-zinc-600"></div>
    <div class="w-3/4 flex items-end justify-center space-y-6 border-b border-zinc-200 dark:border-zinc-700">
        <div class="w-full">
            <div class="grid grid-cols-5 text-sm font-normal uppercase justify-between w-full pr-10">
                <div class="col-span-3">
                    <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Title: </span>
                    <p>{{ $feature->title }}</p>
                </div>
                <div class="col-span-2">
                    <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Funcionalidade: </span>
                    <p>{{ $feature->functionality }}</p>
                </div>
            </div>
        </div>
        {{-- botões --}}
        <div class="flex space-x-8 items-center pb-2">
            <form action="{{ route('feature.edit', $feature->id ) }}" method="ANY">
                @csrf
                <button type="submit"
                    class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
                    <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
                </button>
            </form>
            <form action="{{ route('feature.destroy', $feature->id ) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
                    <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
                </button>
            </form>
        </div>
    </div>
</div>