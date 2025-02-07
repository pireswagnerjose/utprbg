<div>
  <div
    class="mx-auto p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
    <ul
      class="flex flex-wrap h-12 justify-center items-center text-xs font-semibold text-center border-b border-zinc-200 dark:border-zinc-700"
      id="myTab" data-tabs-toggle="#myTabContent" role="tablist">

      @can('show_prisons')
      <li class="mr-1 mb-1 h-full rounded-t-lg bg-zinc-200 dark:bg-zinc-700" role="presentation">
        <button class="inline-block h-full uppercase px-2 py-2 border-b" id="prisoes-tab" data-tabs-target="#prisoes"
          type="button" role="tab" aria-controls="prisoes" aria-selected="false">
          Histórico de<br />Prisões
        </button>
      </li>
      @endcan

      @can('show_processes')
      <li class="mr-1 mb-1 h-full rounded-t-lg bg-zinc-200 dark:bg-zinc-700" role="presentation">
        <button
          class="inline-block h-full uppercase px-2 py-2 border-b border-transparent hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
          id="processos-tab" data-tabs-target="#processos" type="button" role="tab" aria-controls="processos"
          aria-selected="false">
          Processos</button>
      </li>
      @endcan

      @can('show_photos')
      <li class="mr-1 mb-1 h-full rounded-t-lg bg-zinc-200 dark:bg-zinc-700" role="presentation">
        <button
          class="inline-block h-full uppercase px-2 py-2 border-b border-transparent hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
          id="fotos-tab" data-tabs-target="#fotos" type="button" role="tab" aria-controls="fotos" aria-selected="false">
          Fotos</button>
      </li>
      @endcan

      @can('show_addresses')
      <li class="mr-1 mb-1 h-full rounded-t-lg bg-zinc-200 dark:bg-zinc-700" role="presentation">
        <button
          class="inline-block h-full uppercase px-2 py-2 border-b border-transparent hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
          id="enderecos-tab" data-tabs-target="#enderecos" type="button" role="tab" aria-controls="enderecos"
          aria-selected="false">
          Endereços</button>
      </li>
      @endcan

      @can('show_internal_services')
      <li class="mr-1 mb-1 h-full rounded-t-lg bg-zinc-200 dark:bg-zinc-700" role="presentation">
        <button
          class="inline-block h-full uppercase px-2 py-2 border-b border-transparent hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
          id="atendimentos_internos-tab" data-tabs-target="#atendimentos_internos" type="button" role="tab"
          aria-controls="atendimentos_internos" aria-selected="false">
          Atendimentos<br />Internos</button>
      </li>
      @endcan

      @can('show_legal_assistances')
      <li class="mr-1 mb-1 h-full rounded-t-lg bg-zinc-200 dark:bg-zinc-700" role="presentation">
        <button
          class="inline-block h-full uppercase px-2 py-2 border-b border-transparent hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
          id="atendimentos_juridicos-tab" data-tabs-target="#atendimentos_juridicos" type="button" role="tab"
          aria-controls="atendimentos_juridicos" aria-selected="false">
          Atendimentos<br />Jurídicos</button>
      </li>
      @endcan

      @can('show_external_exits')
      <li class="mr-1 mb-1 h-full rounded-t-lg bg-zinc-200 dark:bg-zinc-700" role="presentation">
        <button
          class="inline-block h-full uppercase px-2 py-2 border-b border-transparent hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
          id="saidas_externas-tab" data-tabs-target="#saidas_externas" type="button" role="tab"
          aria-controls="saidas_externas" aria-selected="false">
          Saídas<br />Externas</button>
      </li>
      @endcan

      @can('show_families')
      <li class="mr-1 mb-1 h-full rounded-t-lg bg-zinc-200 dark:bg-zinc-700" role="presentation">
        <button
          class="inline-block h-full uppercase px-2 py-2 border-b border-transparent hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
          id="families-tab" data-tabs-target="#families" type="button" role="tab" aria-controls="families"
          aria-selected="false">
          Familiares</button>
      </li>
      @endcan

      @can('show_documents')
      <li class="mr-1 mb-1 h-full rounded-t-lg bg-zinc-200 dark:bg-zinc-700" role="presentation">
        <button
          class="inline-block h-full uppercase px-2 py-2 border-b border-transparent hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
          id="documents-tab" data-tabs-target="#documents" type="button" role="tab" aria-controls="documents"
          aria-selected="false">
          Documentos</button>
      </li>
      @endcan

      @can('show_pads')
      <li class="mr-1 mb-1 h-full rounded-t-lg bg-zinc-200 dark:bg-zinc-700" role="presentation">
        <button
          class="inline-block h-full uppercase px-2 py-2 border-b border-transparent hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
          id="pads-tab" data-tabs-target="#pads" type="button" role="tab" aria-controls="pads" aria-selected="false">
          PADS</button>
      </li>
      @endcan

      @can('show_visits')
      <li class="mr-1 mb-1 h-full rounded-t-lg bg-zinc-200 dark:bg-zinc-700" role="presentation">
        <button
          class="inline-block h-full uppercase px-2 py-2 border-b border-transparent hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
          id="visitas-tab" data-tabs-target="#visitas" type="button" role="tab" aria-controls="visitas"
          aria-selected="false">
          Visitas</button>
      </li>
      @endcan
    </ul>

    <div id="myTabContent">
      <div class="hidden py-4" id="prisoes" role="tabpanel" aria-labelledby="prisoes-tab">
        <livewire:main.prison.prison-livewire :prisoner_id="$prisoner_show->id" />
      </div>

      <div class="hidden py-4" id="processos" role="tabpanel" aria-labelledby="processos-tab">
        <livewire:main.process.process-livewire :prisoner_id="$prisoner_show->id" />
      </div>

      <div class="hidden py-4" id="fotos" role="tabpanel" aria-labelledby="fotos-tab">
        <livewire:pages.photo.photo-livewire :$prisoner_id />
      </div>

      <div class="hidden py-4" id="enderecos" role="tabpanel" aria-labelledby="enderecos-tab">
        <livewire:main.address.address-livewire :$prisoner_id />
      </div>

      <div class="hidden py-4" id="atendimentos_internos" role="tabpanel" aria-labelledby="atendimentos_internos-tab">
        <livewire:main.internal-service.internal-service-livewire :$prisoner_id />
      </div>

      <div class="hidden py-4" id="atendimentos_juridicos" role="tabpanel" aria-labelledby="atendimentos_juridicos-tab">
        <livewire:main.legal-assistance.legal-assistance-livewire :$prisoner_id />
      </div>

      <div class="hidden py-4" id="saidas_externas" role="tabpanel" aria-labelledby="saidas_externas-tab">
        <livewire:main.external-exit.external-exit-livewire :$prisoner_id />
      </div>

      <div class="hidden py-4" id="families" role="tabpanel" aria-labelledby="families-tab">
        <livewire:main.family.family-livewire :$prisoner_id />
      </div>

      <div class="hidden py-4" id="documents" role="tabpanel" aria-labelledby="documents-tab">
        <livewire:main.document.document-livewire :$prisoner_id />
      </div>

      <div class="hidden py-4" id="pads" role="tabpanel" aria-labelledby="pads-tab">
        <livewire:main.pad.pad-livewire :$prisoner_id />
      </div>

      <div class="hidden py-4" id="visitas" role="tabpanel" aria-labelledby="visitas-tab">
        {{-- Visitantes Relacionados --}}
        <div class="border-b pb-2 border-blue-600">
          <x-item-topic> Visitas Vinculadas </x-item-topic>

          <div class="flex py-3">
            @foreach ($identification_cards as $identification_card)
            <div class="px-4 ">
              <a href="{{ route('visitant.show', ['visitant_id' => $identification_card->visitant_id]) }}"
                class="font-semibold text-blue-700 dark:text-blue-500 hover:underline">
                <span class="flex flex-row items-center gap-2 object-cover">
                  <img class="w-16 h-16 bg-zinc-500 rounded-full shadow-lg"
                    src='{{ asset("storage/" . $identification_card->visitant->photo ) }}'
                    alt="{{ $identification_card->visitant->name }}">
                  <div class="flex flex-col">
                    <h1>{{ $identification_card->visitant->name }}</h1>
                    <span class="text-xs">Contato: {{ $identification_card->visitant->phone }}</span>
                  </div>
                </span>
              </a>
            </div>
            @endforeach
          </div>

        </div>
      </div>
    </div>
  </div>
</div>