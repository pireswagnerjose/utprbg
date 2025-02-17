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

  <!-- add new -->
  <div class="border-b border-blue-400 dark:border-blue-600 flex justify-between">
    @can('create_hearing_with_police_officer')
    <div>
      <button wire:click="modalCreate" type="button"
        class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
      </button>
    </div>
    @endcan
  </div>

  @forelse ($hearing_with_police_officers as $hearing_with_police_officer)
  @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.card')
  @empty
  <p class="w-full flex mt-4 justify-center text-red-500 text-sm">Não existe agendamento com Delegado cadastrado para
    esse preso</p>
  @endforelse

  {{-- paginação --}}
  <div class="pl-2 py-1 text-zinc-50 dark:text-zinc-400">
    {{ $hearing_with_police_officers->onEachSide(1)->links() }}
  </div>

  @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.modal-create')
  @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.modal-update')
  @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.modal-delete')

  {{-- related documents --}}
  @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.related-document-modal-create')
  @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.related-document-modal-delete')
</div>