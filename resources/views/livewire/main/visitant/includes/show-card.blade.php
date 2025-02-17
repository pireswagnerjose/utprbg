<div class="py-1 mx-4">
  {{-- Título da Página --}}
  <x-title-page>Dados do Visitante</x-title-page>
  <div
    class="mx-auto p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-b-lg text-zinc-900 dark:text-zinc-100">

    <div class="flex justify-end mb-5">
      {{-- botões --}}
      <div class="flex justify-end gap-2 px-2">
        {{-- chama o modal para exclusão do item --}}
        @can('delete_visitant')
        <div class="group grid justify-items-center w-12">
          <button type="button" wire:click="modalDelete({{ $visitant->id }})"
            class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
            <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
          </button>
        </div>
        @endcan

        {{-- Editar --}}
        @can('update_visitant')
        <div class="group grid justify-items-center w-12">
          <button wire:click="modalUpdate({{ $visitant->id }})"
            class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
            <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
          </button>
        </div>
        @endcan

        {{-- Relatório PDF --}}
        <form action="{{ route('visitant.report', ['visitant_id' => $visitant->id]) }}" method="POST" target="_blank">
          @csrf
          <div class="group grid justify-items-center w-12">
            <button class="p-2 bg-green-500 dark:bg-green-400/50 hover:opacity-50 transition duration-500 rounded-full">
              <x-lucide-file-text class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-file-text>
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- Conteúdo da Página --}}
    <div class="grid grid-cols-12 gap-4 mb-5">
      {{-- foto do perfil --}}
      <div class="w-full max-h-72 col-span-2">
        <span class="flex flex-col w-full items-center">
          <img class="object-cover h-full w-full rounded-lg" src='{{ asset("storage/$visitant->photo") }}'
            alt="{{ $visitant->name }}">
        </span>
      </div>

      <div class="w-full col-span-10">
        {{-- linha 1 --}}
        <div class="grid grid-cols-4 gap-4 mb-5">
          <div class="col-span-2">
            <x-item-topic>Nome</x-item-topic>
            <x-item-data>{{ $visitant->name }}</x-item-data>
          </div>
          <div>
            <x-item-topic>Data Nasc.</x-item-topic>
            @empty(!$visitant->date_of_birth)
            <x-item-data>{{ \Carbon\Carbon::parse($visitant->date_of_birth)->format('d/m/Y') }}
            </x-item-data>
            @endempty
          </div>
          <div>
            <x-item-topic>CPF</x-item-topic>
            <x-item-data>{{ $visitant->cpf }}</x-item-data>
          </div>
        </div>

        {{-- Linha 2 --}}
        <div class="grid grid-cols-4 gap-4 mb-5">
          <div>
            <x-item-topic>Estado Civil</x-item-topic>
            <x-item-data>{{ $visitant->civil_status->civil_status }}</x-item-data>
          </div>

          <div>
            <x-item-topic>Sexo</x-item-topic>
            <x-item-data>{{ $visitant->sex->sex }}</x-item-data>
          </div>

          <div>
            <x-item-topic>Status</x-item-topic>
            <x-item-data>{{ $visitant->status }}</x-item-data>
          </div>

          <div>
            <x-item-topic>Fone</x-item-topic>
            <x-item-data>{{ $visitant->phone }}</x-item-data>
          </div>
        </div>

        {{-- linha 3 --}}
        <div class="grid grid-cols-7 gap-4 mb-5">
          <div class="col-span-3">
            <x-item-topic>Logradouro</x-item-topic>
            <x-item-data>{{ $visitant->street }}</x-item-data>
          </div>

          <div class="col-span-1">
            <x-item-topic>Número</x-item-topic>
            <x-item-data>{{ $visitant->number }}</x-item-data>
          </div>

          <div class="col-span-2">
            <x-item-topic>Complemento</x-item-topic>
            <x-item-data>{{ $visitant->complement }}</x-item-data>
          </div>

          <div class="col-span-1">
            <x-item-topic>Tipo de Residência</x-item-topic>
            <x-item-data>{{ $visitant->type_of_residence }}</x-item-data>
          </div>
        </div>

        {{-- Linha 4 --}}
        <div class="grid grid-cols-3 gap-4 mb-5">
          <div>
            <x-item-topic>Bairro</x-item-topic>
            <x-item-data>{{ $visitant->barrio }}</x-item-data>
          </div>
          <div>
            <x-item-topic>Cidade</x-item-topic>
            <x-item-data>{{ $visitant->municipality->municipality }}</x-item-data>
          </div>
          <div>
            <x-item-topic>Estado</x-item-topic>
            <x-item-data>{{ $visitant->state->state }}</x-item-data>
          </div>
        </div>

        {{-- linha 5 --}}
        <div>
          <x-item-topic>Informações Complementares</x-item-topic>
          <x-item-data>{{ $visitant->remark }}</x-item-data>
        </div>
      </div>
    </div>

    {{-- Presos Relacionados --}}
    <div class="border-t pt-2 border-blue-600">
      <x-item-topic> Presos Vinculados </x-item-topic>
      <div class="grid grid-cols-2 gap-4 my-4 ">
        <div class="px-4 ">
          @foreach ($visitant->identification_cards as $identification_card)
          <a href="{{ route('prisoners.show', ['prisoner_id' => $identification_card->prisoner_id]) }}"
            class="font-semibold text-blue-700 dark:text-blue-500 hover:underline">
            <span class="flex flex-row items-center gap-2 object-cover">
              <img class="w-16 h-16 bg-zinc-500 rounded-full shadow-lg"
                src='{{ asset("storage/" . $identification_card->prisoner->photo ) }}'
                alt="{{ $identification_card->prisoner->name }}">
              <div class="flex flex-col">
                <h1>{{ $identification_card->prisoner->name }}</h1>
                <span class="text-xs">Data Nasc.: {{
                  \Carbon\Carbon::parse($identification_card->prisoner->date_birth)->format('d/m/Y') }}</span>
              </div>
            </span>
          </a>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Documentos Relacionados --}}
    <div>
      <div class="grid mb-5 border-t pt-2 border-blue-600 ">
        <x-item-topic> Documentos do Visitante </x-item-topic>
        <div class="px-4">
          <livewire:main.visitant.visitant-document-livewire :visitant_id="$visitant->id" />
        </div>
      </div>
    </div>
  </div>
</div>