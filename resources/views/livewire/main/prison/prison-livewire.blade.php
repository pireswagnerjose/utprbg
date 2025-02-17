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

  {{-- add new --}}
  <div class="flex items-center border-b border-blue-400 dark:border-blue-600">
    @can('create_prison')
    <div>
      <button wire:click="modalPrisonCreate({{ $prisoner_id }})" type="button"
        class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
      </button>
    </div>
    @endcan
  </div>

  {{-- MODAL PRISON --}}
  @include('livewire.main.prison.includes.modal-create')
  @include('livewire.main.prison.includes.modal-update')
  @include('livewire.main.prison.includes.modal-delete')
  @include('livewire.main.prison.includes.show-card')

  {{-- MODAL PRISON DOCUMENT --}}
  @include("livewire.main.prison.includes.document-modal-create")
  @include("livewire.main.prison.includes.document-modal-update")
  @include("livewire.main.prison.includes.document-modal-delete")
</div>