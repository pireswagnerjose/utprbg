<div data-te-lightbox-init class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
  @if ($photos)
  @forelse ($photos as $photo)
  <div class="text-center">

    {{-- botões de edição e exclusão --}}
    <div class="flex space-x-2 mb-2">
      {{-- Editar --}}
      @can('update_photo')
      <button wire:click="modal({{ $photo->id }})"
        class="p-1 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
      </button>
      @endcan

      {{-- Excluir --}}
      @can('delete_photo')
      <button type="button" wire:confirm="Tem certeza que deseja excluir a Foto" wire:click="delete({{ $photo->id }})"
        class="p-1 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
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