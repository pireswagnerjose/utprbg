<div class="mb-1 px-6">
  {{-- botões --}}
  <div class="flex justify-end gap-2 my-2">
    {{-- chama o modal para exclusão do item --}}
    @can('delete_prisoner')
    <div class="group grid justify-items-center w-12">
      <button type="button" wire:confirm="Tem certeza que deseja excluir o Preso"
        wire:click="delete({{ $prisoner_show->id }})"
        class="p-2 bg-red-700 dark:bg-red-600/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-x class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-x>
      </button>
    </div>
    @endcan

    {{-- Editar --}}
    @can('update_prisoner')
    <div class="group grid justify-items-center w-12">
      <button wire:click="modal({{ $prisoner_show->id }})"
        class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
      </button>
    </div>
    @endcan

    {{-- Relatório PDF --}}
    @can('create_pdf_prisoner')
    <div class="group grid justify-items-center w-12">
      <button wire:click="modalReport({{ $prisoner_show->id }})"
        class="p-2 bg-green-500 dark:bg-green-400/50 hover:opacity-50 transition duration-500 rounded-full">
        <x-lucide-file-text class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-file-text>
      </button>
    </div>
    @endcan
  </div>


  {{-- Conteúdo da Página --}}
  <div class="grid md:grid-cols-12 gap-4 mb-5">

    {{-- Foto e Localização --}}
    <div class="md:col-span-2 w-full">

      {{-- Foto do Perfil --}}
      @include('livewire.pages.prisoner.includes.profile-photo')

      {{-- Localização na Unidade --}}
      <div class="mt-4 text-center">
        @if (!empty( $prisoner_show->unit_address))
        @foreach ( $prisoner_show->unit_address as $unit_address)
        @if ($unit_address->status == "ATIVO")
        <dd class="font-normal text-xs">ALA / CELA</dd>
        <dd class="text-sm font-semibold uppercase">{{ $unit_address->cell->cell }}</dd>
        @endif
        @endforeach
        @endif
      </div>
      @can('create_update_unit_address_prisoner')
      <livewire:pages.unit-address.unit-address-livewire :prisoner_id="$prisoner_show->id" />
      @endcan


    </div>
    <div class="md:col-span-10 w-full">
      {{-- linha 1 --}}
      <div class="grid md:grid-cols-4 gap-4 mb-5">
        <div class="md:col-span-2 w-full">
          <x-item-topic>Nome</x-item-topic>
          <x-item-data>{{ $prisoner_show->name }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>vulgo</x-item-topic>
          <x-item-data>{{ $prisoner_show->nickname }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Data Nasc.</x-item-topic>
          @empty(!$prisoner_show->date_birth)
          <x-item-data>{{ \Carbon\Carbon::parse($prisoner_show->date_birth)->format('d/m/Y') }}</x-item-data>
          @endempty
        </div>
      </div>
      {{-- linha 2 --}}
      <div class="grid md:grid-cols-4 gap-4 mb-5">
        <div class="md:col-span-1 w-full">
          <x-item-topic>CPF</x-item-topic>
          <x-item-data>{{ $prisoner_show->cpf }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>RG</x-item-topic>
          <x-item-data>{{ $prisoner_show->rg }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Título Eleitor</x-item-topic>
          <x-item-data>{{ $prisoner_show->title }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Certidão Nascimento</x-item-topic>
          <x-item-data>{{ $prisoner_show->birth_certificate }}</x-item-data>
        </div>
      </div>
      {{-- linha 3 --}}
      <div class="grid md:grid-cols-5 gap-4 mb-5">
        <div class="md:col-span-1 w-full">
          <x-item-topic>Reservista</x-item-topic>
          <x-item-data>{{ $prisoner_show->reservist }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Cartão Sus</x-item-topic>
          <x-item-data>{{ $prisoner_show->sus_card }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>RJI</x-item-topic>
          <x-item-data>{{ $prisoner_show->rji }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Etnia</x-item-topic>
          <x-item-data>{{ $prisoner_show->ethnicity->ethnicity }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Orientação Sexual</x-item-topic>
          <x-item-data>{{ $prisoner_show->sexual_orientation->sexual_orientation }}</x-item-data>
        </div>
      </div>
      {{-- linha 4 --}}
      <div class="grid md:grid-cols-2 gap-4 mb-5">
        <div class="md:col-span-1 w-full">
          <x-item-topic>Mãe</x-item-topic>
          <x-item-data>{{ $prisoner_show->mother }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Pai</x-item-topic>
          <x-item-data>{{ $prisoner_show->father }}</x-item-data>
        </div>
      </div>
      {{-- linha 5 --}}
      <div class="grid md:grid-cols-5 gap-4 mb-5">
        <div class="md:col-span-2 w-full">
          <x-item-topic>Escolaridade</x-item-topic>
          <x-item-data>{{ $prisoner_show->education_level->education_level }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Estado Civil</x-item-topic>
          <x-item-data>{{ $prisoner_show->civil_status->civil_status }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Sexo</x-item-topic>
          <x-item-data>{{ $prisoner_show->sex->sex }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Status da Prisão</x-item-topic>
          <x-item-data>{{ $prisoner_show->status_prison->status_prison }}</x-item-data>
        </div>
      </div>
      {{-- linha 6 --}}
      <div class="grid md:grid-cols-4 gap-4 mb-5">
        <div class="md:col-span-1 w-full">
          <x-item-topic>Profissão</x-item-topic>
          <x-item-data>{{ $prisoner_show->profession }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Naturalidade</x-item-topic>
          <x-item-data>{{ $prisoner_show->municipality->municipality }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>UF</x-item-topic>
          <x-item-data>{{ $prisoner_show->state->state }}</x-item-data>
        </div>
        <div class="md:col-span-1 w-full">
          <x-item-topic>Nacionalidade</x-item-topic>
          <x-item-data>{{ $prisoner_show->country->country }}</x-item-data>
        </div>
      </div>
      {{-- linha 7 --}}
      <div class="w-full">
        <x-item-topic>Informações Complementares</x-item-topic>
        <x-item-data>{{ $prisoner_show->remarks }}</x-item-data>
      </div>
    </div>
  </div>
</div>