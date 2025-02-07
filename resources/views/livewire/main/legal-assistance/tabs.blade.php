<div class="border-b border-zinc-200 dark:border-zinc-700">
  <ul class="flex flex-wrap -mb-px text-xs font-medium text-center" id="default-tab"
    data-tabs-toggle="#default-tab-content" role="tablist">
    @can('show_assistance_with_lawyers')
    <li class="me-2" role="presentation">
      <button class="inline-block p-4 border-b-2 rounded-t-lg" id="atendimento-com-advogado-tab"
        data-tabs-target="#atendimento-com-advogado" type="button" role="tab" aria-controls="atendimento-com-advogado"
        aria-selected="false">Atendimento com Advogado</button>
    </li>
    @endcan

    @can('show_assistante_with_public_defender')
    <li class="me-2" role="presentation">
      <button
        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
        id="atendimento-com-defensor-publico-tab" data-tabs-target="#atendimento-com-defensor-publico" type="button"
        role="tab" aria-controls="atendimento-com-defensor-publico" aria-selected="false">
        Atendimento com Defensor Público
      </button>
    </li>
    @endcan

    @can('show_videoconference_hearing')
    <li class="me-2" role="presentation">
      <button
        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
        id="videoconference_hearing-tab" data-tabs-target="#videoconference_hearing" type="button" role="tab"
        aria-controls="videoconference_hearing" aria-selected="false">
        Audiência por videoconferência
      </button>
    </li>
    @endcan

    @can('show_hearing_with_police_officer')
    <li role="presentation">
      <button
        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
        id="hearing_with_police_officer-tab" data-tabs-target="#hearing_with_police_officer" type="button" role="tab"
        aria-controls="hearing_with_police_officer" aria-selected="false">Oitiva com Delegado</button>
    </li>
    @endcan

    @can('show_restorative_justice')
    <li role="presentation">
      <button
        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-zinc-600 hover:border-zinc-300 dark:hover:text-zinc-300"
        id="restorative_justice-tab" data-tabs-target="#restorative_justice" type="button" role="tab"
        aria-controls="restorative_justice" aria-selected="false">Justiça Restaurativa</button>
    </li>
    @endcan
  </ul>
</div>
<div id="default-tab-content">
  <div class="hidden p-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="atendimento-com-advogado" role="tabpanel"
    aria-labelledby="atendimento-com-advogado-tab">
    <livewire:main.legal-assistance.assistance-with-lawyer.assistance-with-lawyer-livewire :$prisoner_id />
  </div>
  <div class="hidden p-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="atendimento-com-defensor-publico" role="tabpanel"
    aria-labelledby="atendimento-com-defensor-publico-tab">
    <livewire:main.legal-assistance.assistance-with-public-defender.assistance-with-public-defender-livewire
      :$prisoner_id />
  </div>
  <div class="hidden p-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="videoconference_hearing" role="tabpanel"
    aria-labelledby="videoconference_hearing-tab">
    <livewire:main.legal-assistance.videoconference-hearing.videoconference-hearing-livewire :$prisoner_id />
  </div>
  <div class="hidden p-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="hearing_with_police_officer" role="tabpanel"
    aria-labelledby="hearing_with_police_officer-tab">
    <livewire:main.legal-assistance.hearing-with-police-officer.hearing-with-police-officer-livewire :$prisoner_id />
  </div>
  <div class="hidden p-4 rounded-lg bg-zinc-50 dark:bg-zinc-800" id="restorative_justice" role="tabpanel"
    aria-labelledby="restorative_justice-tab">
    <livewire:main.legal-assistance.restorative-justice.restorative-justice-livewire :$prisoner_id />
  </div>
</div>