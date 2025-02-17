<div>
  {{-- add new --}}
  <div class="flex items-center border-b border-blue-400 dark:border-blue-600 mb-4">
    @can('create_address')
    <div>
      <button wire:click="modalAddressCreate" type="button"
        class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
      </button>
    </div>
    @endcan
  </div>
  @include('livewire.main.address.includes.modal-create')
  @include('livewire.main.address.includes.modal-update')
  @include('livewire.main.address.includes.modal-delete')
  @include('livewire.main.address.includes.show-card')
</div>