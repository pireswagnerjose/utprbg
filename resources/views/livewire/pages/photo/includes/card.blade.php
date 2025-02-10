<div data-te-lightbox-init class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
  @if ($photos)
  @forelse ($photos as $photo)
  <div class="text-center">

    {{-- botões de edição e exclusão --}}
    <div class="flex space-x-2 mb-2">
      {{-- Editar --}}
      @can('update_photo')
      <button wire:click="modal({{ $photo->id }})"
        class="w-5 h-5 p-1 bg-blue-600 dark:bg-blue-500 rounded-full shadow-lg">
        <svg class=" w-3 h-3 text-blue-50 dark:text-blue-50 hover:text-blue-400 hover:dark:text-blue-400"
          aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4.109 17H1v-2a4 4 0 0 1 4-4h.87M10 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm7.95 2.55a2 2 0 0 1 0 2.829l-6.364 6.364-3.536.707.707-3.536 6.364-6.364a2 2 0 0 1 2.829 0Z" />
        </svg>
      </button>
      @endcan

      {{-- Excluir --}}
      @can('delete_photo')
      <button type="button" wire:confirm="Tem certeza que deseja excluir a Foto" wire:click="delete({{ $photo->id }})"
        class="w-5 h-5 p-1 bg-red-600 dark:bg-red-500 rounded-full shadow-lg">
        <svg class="w-3 h-3 text-red-50 dark:text-red-50 hover:text-red-400 hover:dark:text-red-400" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 8h6m-9-3.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
        </svg>
      </button>
      @endcan
    </div>

    {{-- imagens --}}
    <div class="h-52 w-52 shadow-xl">
      <img src='{{ asset("storage/$photo->photo") }}' data-te-img='{{ asset("storage/$photo->photo") }}'
        alt="{{ $photo->description }}"
        class="h-52 w-52 cursor-zoom-in rounded shadow-sm data-[te-lightbox-disabled]:cursor-auto" />
    </div>

    {{-- descrição --}}
    <div class="font-light pt-2 text-[9pt] text-zinc-500">{{ $photo->position }}</div>
    <div class="font-medium text-[10pt] uppercase">{{ $photo->description }}</div>
  </div>

  {{-- mensagem exibina de não houver dados --}}
  @empty
  <div class="flex items-center dark:text-white dark:divide-gray-700">
    <dd class="md:text-sm text-center font-normal text-gray-700 dark:text-gray-100">
      Não existe foto cadastrada para esse preso
    </dd>
  </div>
  @endforelse
  @endif
</div>
{{-- paginação --}}
<div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
  {{ $photos->onEachSide(1)->links() }}
</div>