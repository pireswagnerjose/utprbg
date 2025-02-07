{{-- Conteúdo da Página --}}
<div class="w-[75%] mx-auto">
  <div class="flex justify-between space-y-2">
    <div class="flex items-center">
      <p>{{ $ability->name }}</p>
    </div>

    <div>
      @if ($role->abilities()->pluck('ability_id')->contains($ability->id))
      <form class="flex items-center justify-center gap-2 text-xs font-light text-zinc-400 dark:text-zinc-600"
        action="{{ route('permission.destroy', ['id' => $ability->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <p class="mb-2">Revogar</p>
        <button type="submit"
          class="flex items-center justify-center w-7 h-7 bg-red-700 hover:bg-red-800 dark:bg-red-600/50 dark:hover:bg-red-700/50 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-full dark:focus:ring-red-800">
          <i data-lucide="x" class="w-5 h-5 text-zinc-100 dark:text-zinc-200"></i>
        </button>
      </form>
      @else
      <div class="flex items-center justify-center gap-2 text-xs font-light text-zinc-400 dark:text-zinc-600">
        <p class="mb-2">Permitir</p>
        <a class="flex items-center justify-center w-7 h-7 bg-blue-700 hover:bg-blue-800 dark:bg-blue-600/50 dark:hover:bg-blue-700/50 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full dark:focus:ring-blue-800"
          href="{{ route('permission.create', ['ability_id' => $ability->id, 'role_id' => $role->id]) }}">
          <i data-lucide="plus" class="w-5 h-5 text-zinc-100 dark:text-zinc-200"></i>
        </a>
      </div>
      @endif
    </div>
  </div>
</div>