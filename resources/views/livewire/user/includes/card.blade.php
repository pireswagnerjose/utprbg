{{-- Conteúdo da Página --}}
<div class="flex justify-center ">
  <div
    class="w-full flex items-end justify-center space-y-6 hover:bg-zinc-200 dark:hover:bg-zinc-700 border-b border-zinc-200 dark:border-zinc-700">
    <div class="pl-3 w-full">
      <div class="grid grid-cols-6 gap-8 text-base font-semibold uppercase justify-between w-full pr-12">
        <div class="col-span-2">
          <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Nome: </span>
          <p>{{ $user->first_name }} {{ $user->last_name }}</p>
        </div>
        <div class="col-span-2">
          <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Email: </span>
          <p>{{ $user->email }}</p>
        </div>
        <div>
          <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Tel.: </span>
          <p>{{ $user->phone }}</p>
        </div>
        <div>
          <span class="font-light text-xs text-zinc-400 dark:text-zinc-500">Nível de Acesso.: </span>
          @foreach ( $user->roles as $role)
          <span> {{ $role->name }} </span>
          @endforeach
        </div>
      </div>
    </div>
    {{-- botões --}}
    <div class="flex space-x-8 items-center pb-2">
      <button wire:click="confirmgUserUpdate({{ $user->id }})"
        class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
      </button>

      <button wire:click="confirmUserDeletion({{ $user->id }})" wire:loading.attr="disabled"
        class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
      </button>
    </div>
  </div>
</div>