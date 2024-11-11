<div class="py-1 mx-4">
    <div class="mx-auto p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
        <ul class="flex flex-wrap justify-center text-xs font-semibold text-center border-b border-zinc-200 dark:border-zinc-700" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-1 mb-1 bg-zinc-200 dark:bg-zinc-700" role="presentation">
                <button class="inline-block px-2 py-2 border-b rounded-t-lg" id="prisoes-tab" data-tabs-target="#prisoes" type="button" role="tab" aria-controls="prisoes" aria-selected="false">
                    Histórico de Prisões
                </button>
            </li>
            <li class="mr-1 mb-1 bg-zinc-200 dark:bg-zinc-700" role="presentation">
                <button class="inline-block px-2 py-2 border-b border-transparent rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
                    id="processos-tab" data-tabs-target="#processos" type="button" role="tab" aria-controls="processos" aria-selected="false">
                    Processos</button>
            </li>
            <li class="mr-1 mb-1 bg-zinc-200 dark:bg-zinc-700" role="presentation">
                <button class="inline-block px-2 py-2 border-b border-transparent rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
                    id="fotos-tab" data-tabs-target="#fotos" type="button" role="tab" aria-controls="fotos" aria-selected="false">
                    Fotos</button>
            </li>
            <li class="mr-1 mb-1 bg-zinc-200 dark:bg-zinc-700" role="presentation">
                <button class="inline-block px-2 py-2 border-b border-transparent rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
                    id="enderecos-tab" data-tabs-target="#enderecos" type="button" role="tab" aria-controls="enderecos" aria-selected="false">
                    Endereços</button>
            </li>
            <li class="mr-1 mb-1 bg-zinc-200 dark:bg-zinc-700" role="presentation">
                <button class="inline-block px-2 py-2 border-b border-transparent rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
                    id="atendimentos_internos-tab" data-tabs-target="#atendimentos_internos" type="button" role="tab" aria-controls="atendimentos_internos" aria-selected="false">
                    Atendimentos Internos</button>
            </li>
            <li class="mr-1 mb-1 bg-zinc-200 dark:bg-zinc-700" role="presentation">
                <button class="inline-block px-2 py-2 border-b border-transparent rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
                    id="atendimentos_juridicos-tab" data-tabs-target="#atendimentos_juridicos" type="button" role="tab" aria-controls="atendimentos_juridicos" aria-selected="false">
                    Atendimentos Jurídicos</button>
            </li>
            <li class="mr-1 mb-1 bg-zinc-200 dark:bg-zinc-700" role="presentation">
                <button class="inline-block px-2 py-2 border-b border-transparent rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
                    id="saidas_externas-tab" data-tabs-target="#saidas_externas" type="button" role="tab" aria-controls="saidas_externas" aria-selected="false">
                    Saídas Externas</button>
            </li>
            <li class="mr-1 mb-1 bg-zinc-200 dark:bg-zinc-700" role="presentation">
                <button class="inline-block px-2 py-2 border-b border-transparent rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
                    id="families-tab" data-tabs-target="#families" type="button" role="tab" aria-controls="families" aria-selected="false">
                    Familiares</button>
            </li>
            <li class="mr-1 mb-1 bg-zinc-200 dark:bg-zinc-700" role="presentation">
                <button class="inline-block px-2 py-2 border-b border-transparent rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
                    id="documents-tab" data-tabs-target="#documents" type="button" role="tab" aria-controls="documents" aria-selected="false">
                    Documentos</button>
            </li>
            <li class="mr-1 mb-1 bg-zinc-200 dark:bg-zinc-700" role="presentation">
                <button class="inline-block px-2 py-2 border-b border-transparent rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
                    id="pads-tab" data-tabs-target="#pads" type="button" role="tab" aria-controls="pads" aria-selected="false">
                    PADS</button>
            </li>
            <li class="mr-1 mb-1 bg-zinc-200 dark:bg-zinc-700" role="presentation">
                <button class="inline-block px-2 py-2 border-b border-transparent rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
                    id="visitas-tab" data-tabs-target="#visitas" type="button" role="tab" aria-controls="visitas" aria-selected="false">
                    Visitas Agendadas</button>
            </li>
        </ul>

        <div id="myTabContent">
            <div class="hidden py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="prisoes" role="tabpanel" aria-labelledby="prisoes-tab">
                <livewire:main.prison.prison-livewire :prisoner_id="$prisoner->id"/>
            </div>
            <div class="hidden py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="processos" role="tabpanel" aria-labelledby="processos-tab">
                <livewire:main.process.process-livewire :prisoner_id="$prisoner->id"/>
            </div>
            <div class="hidden py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="fotos" role="tabpanel" aria-labelledby="fotos-tab">
                <livewire:main.photo.photo-livewire :$prisoner_id />
            </div>
            <div class="hidden py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="enderecos" role="tabpanel" aria-labelledby="enderecos-tab">
                <livewire:main.address.address-livewire :$prisoner_id />
            </div>
            <div class="hidden py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="atendimentos_internos" role="tabpanel" aria-labelledby="atendimentos_internos-tab">
                <livewire:main.internal-service.internal-service-livewire :$prisoner_id />
            </div>
            <div class="hidden py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="atendimentos_juridicos" role="tabpanel" aria-labelledby="atendimentos_juridicos-tab">
                <livewire:main.legal-assistance.legal-assistance-livewire :$prisoner_id />
            </div>
            <div class="hidden py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="saidas_externas" role="tabpanel" aria-labelledby="saidas_externas-tab">
                <livewire:main.external-exit.external-exit-livewire :$prisoner_id />
            </div>
            <div class="hidden py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="families" role="tabpanel" aria-labelledby="families-tab">
                <livewire:main.family.family-livewire :$prisoner_id />
            </div>
            <div class="hidden py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                <livewire:main.document.document-livewire :$prisoner_id />
            </div>
            <div class="hidden py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="pads" role="tabpanel" aria-labelledby="pads-tab">
                <livewire:main.pad.pad-livewire :$prisoner_id />
            </div>
            <div class="hidden py-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="visitas" role="tabpanel" aria-labelledby="visitas-tab">
                {{-- <livewire:main.booking-visit.booking-visit-livewire :$prisoner_id /> --}}
            </div>
        </div>
    </div>
</div>