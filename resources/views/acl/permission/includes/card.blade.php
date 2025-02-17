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
          class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
          <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
        </button>
      </form>
      @else
      <div class="flex items-center justify-center gap-2 text-xs font-light text-zinc-400 dark:text-zinc-600">
        <p class="mb-2">Permitir</p>
        <a href="{{ route('permission.create', ['ability_id' => $ability->id, 'role_id' => $role->id]) }}"
          class="p-2 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
          <x-lucide-plus class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
        </a>
      </div>
      @endif
    </div>
  </div>
</div>