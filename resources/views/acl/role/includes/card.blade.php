{{-- Conteúdo da Página --}}
<div class="flex justify-center ">
  <div class="odd:bg-zinc-200 even:bg-zinc-600"></div>
  <div class="w-3/4 flex items-end justify-center space-y-6 border-b border-zinc-200 dark:border-zinc-700">
    <div class="w-full">
      <div class="grid grid-cols-5 text-base font-semibold uppercase justify-between w-full pr-12">
        <div class="col-span-3">
          <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Grupo: </span>
          <p>{{ $role->name }}</p>
        </div>
        <div
          class="col-span-1 flex items-end mb-1 justify-center gap-2 text-xs font-light text-zinc-400 dark:text-zinc-600">
          <p class="mb-2">Permitir</p>
          <a class="flex items-center justify-center w-7 h-7 bg-blue-700 hover:bg-blue-800 dark:bg-blue-600/50 dark:hover:bg-blue-700/50 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full dark:focus:ring-blue-800"
            href="{{ route('permission.edit', $role->id) }}">
            <x-lucide-arrow-right-left class="w-5 h-5 text-zinc-100/50 dark:text-zinc-200/50">
            </x-lucide-arrow-right-left>
          </a>
          <p class="mb-2">Revogar</p>
        </div>
        <div class="grid justify-items-end">
          <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Criado em: </span>
          <p>{{ \Carbon\Carbon::parse($role->created_at)->format('d/m/Y' ) }}</p>
        </div>
      </div>
    </div>
    {{-- botões --}}
    <div class="flex space-x-8 items-center pb-2">
      <form action="{{ route('role.edit', $role->id ) }}" method="ANY">
        @csrf
        <button type="submit"
          class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
          <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
        </button>
      </form>
      <form action="{{ route('role.destroy', $role->id ) }}" method="POST">
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