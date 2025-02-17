<div>
  <!-- Mensagens -->
  <div class="w-full text-center">
    @if (session('success'))
    <span class="text-green-500 text-sm">{{ session('success') }}</span>
    @endif
    @if (session('error'))
    <span class="text-red-500 text-sm">{{ session('error') }}</span>
    @endif
  </div>

  <div
    class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

    <div class="flex mb-4">
      <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">Lista de Ususários</h2>
    </div>

    {{-- Botão Adicionar Novo --}}
    <div class="flex items-center mb-6 ml-16">
      <button wire:click="addNew" type="button"
        class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
      </button>
    </div>

    {{-- create --}}
    @if($add_new == true)
    @include('livewire.user.includes.create')
    @endif

    {{-- search --}}
    @include('livewire.user.includes.search')

    {{-- card --}}
    @foreach ($users as $user)
    @include('livewire.user.includes.card')
    @endforeach
    @include('livewire.user.includes.modal-update')
    @include('livewire.user.includes.modal-delete')

    {{-- paginação --}}
    <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
      {{ $users->onEachSide(1)->links() }}
    </div>
  </div>
</div>