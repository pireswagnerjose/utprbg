<div>

  <nav>
    <ul class="flex flex-row sm:flex-row px-8 gap-4 justify-center items-center bg-zinc-500 dark:bg-zinc-700">
      {{-- presos --}}
      @can('admin-saude-guest')
      <li>
        <div x-data="{
                        open: false,
                        toggle() {
                            if (this.open) {
                                return this.close()
                            }
                            this.$refs.button.focus()
                            this.open = true
                        },
                        close(focusAfter) {
                            if (! this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
          x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

          <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button"
            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
            <div class="hidden sm:flex">
              <i data-lucide="user" class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400"></i>
            </div>
            <span class="py-2">Presos</span>
          </button>
          <div
            class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
            <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
              :id="$id('dropdown-button')" style="display: none;"
              class="p-4 pb-0 space-y-2 text-zinc-900 md:pb-4 dark:text-white">

              {{-- pesquisa de preso --}}
              <a href="{{ route('prisoners.search') }}" wire:navigate
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                Pesquisar
              </a>
            </div>
          </div>
        </div>
      </li>
      @endcan

      {{-- Visitantes --}}
      @can('admin-recepcao-guest')
      <li>
        <div x-data="{
                        open: false,
                        toggle() {
                            if (this.open) {
                                return this.close()
                            }
                            this.$refs.button.focus()
                            this.open = true
                        },
                        close(focusAfter) {
                            if (! this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
          x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

          <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button"
            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
            <div class="hidden sm:flex">
              <i data-lucide="baby" class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400"></i>
            </div>
            <span class="py-2">Visitas</span>
          </button>
          <div
            class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
            <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
              :id="$id('dropdown-button')" style="display: none;"
              class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white">
              {{-- Página de Gerenciamento do Visitante --}}
              <a href="{{ route('visitant.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Visitante</span>
              </a>

              {{-- Página de Gerenciamento da Carteirinha do Visitante --}}
              @can('admin-recepcao')
              <a href="{{ route('identification-card.index') }}" wire:navigate
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                Carteirinha
              </a>
              @endcan

              {{-- Periodo de Agendamento das Visitas --}}
              @can('admin-recepcao')
              <a href="{{ route('visit-scheduling-date.index') }}" wire:navigate
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                Periodo de Agendamento das Visitas
              </a>
              @endcan

              {{-- Controle de Visitas --}}
              @can('admin-recepcao')
              <a href="{{ route('visit-control.index') }}" wire:navigate
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                Controle de Visitas
              </a>
              @endcan

              {{-- Visitas Agendadas --}}
              @can('admin-recepcao')
              <a href="{{ route('visit-report.index') }}" wire:navigate
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                Visitas Agendadas
              </a>
              @endcan
            </div>
          </div>
        </div>
      </li>
      @endcan

      {{-- tabelas acessórias --}}
      @can('admin')
      <li>
        <div x-data="{
                        open: false,
                        toggle() {
                            if (this.open) {
                                return this.close()
                            }
                            this.$refs.button.focus()
                            this.open = true
                        },
                        close(focusAfter) {
                            if (! this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
          x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
          class="grid justify-items-center">

          <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button"
            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
            <div class="hidden sm:flex">
              <i data-lucide="grid-2x2-plus" class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400"></i>
            </div>
            <span class="py-2">Acessórios</span>
          </button>
          <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')" style="display: none;"
            class="absolute z-10 grid grid-cols-3 mt-10 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 dark:bg-zinc-700">

            {{-- coluna 1 --}}
            <div
              class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white border-0 border-r border-zinc-200 dark:border-zinc-600">
              <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Cadastros
                Gerais</span>
              {{-- País --}}
              <a href="{{ route('countries.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">País</span>
              </a>
              {{-- Estado --}}
              <a href="{{ route('states.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Estado</span>
              </a>
              {{-- Município --}}
              <a href="{{ route('municipalities.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Município</span>
              </a>
              {{-- Unidade Prisional --}}
              <a href="{{ route('prison-units.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Unidade Prisional</span>
              </a>
              {{-- Escolaridade --}}
              <a href="{{ route('education-levels.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Escolaridade</span>
              </a>
              {{-- Estado Civil --}}
              <a href="{{ route('civil-statuses.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Estado Civil</span>
              </a>
              {{-- Etnia --}}
              <a href="{{ route('ethnicities.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Etnia</span>
              </a>
              {{-- Orientação Sexual --}}
              <a href="{{ route('sexual-orientations.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Orientação Sexual</span>
              </a>
              {{-- Sexo --}}
              <a href="{{ route('sexes.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Sexo</span>
              </a>

              <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Cadastros da
                Unidade</span>
              {{-- Viaturas --}}
              <a href="#"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Viaturas</span>
              </a>
              {{-- Ala (Pavilhão) --}}
              <a href="{{ route('wards.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Ala (Pavilhão)</span>
              </a>
              {{-- Cela --}}
              <a href="{{ route('cells.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Cela</span>
              </a>
            </div>

            {{-- coluna 2 --}}
            <div
              class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white border-0 border-r border-zinc-200 dark:border-zinc-600">
              <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Prisões</span>
              {{-- Origem da Prisão --}}
              <a href="{{ route('prison-origins.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Origem da Prisão</span>
              </a>
              {{-- Tipo da Prisão --}}
              <a href="{{ route('type-prisons.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Tipo da Prisão</span>
              </a>
              {{-- Status da Prisão --}}
              <a href="{{ route('status-prisons.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Status da Prisão</span>
              </a>
              {{-- Tipo da Saída --}}
              <a href="{{ route('output-types.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Tipo da Saída</span>
              </a>

              {{-- --}}
              <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Processos</span>
              {{-- Tipo Penal --}}
              <a href="{{ route('penal-types.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Tipo Penal</span>
              </a>
              {{-- Origem do Processo --}}
              <a href="{{ route('origin-processes.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Origem do Processo</span>
              </a>
              {{-- Regime do Processo --}}
              <a href="{{ route('process-regimes.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Regime do Processo</span>
              </a>

              {{-- --}}
              <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Atendimentos
                Internos</span>
              {{-- Tipo de Atendimento Interno --}}
              <a href="{{ route('type-services.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Tipo de Atendimento Interno</span>
              </a>

              {{-- --}}
              <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Saídas
                Externas</span>
              {{-- Requisitante --}}
              <a href="{{ route('requestings.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Requisitante</span>
              </a>
              {{-- Motivo da Saída --}}
              <a href="{{ route('exit-reasons.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Motivo da Saída</span>
              </a>
            </div>

            {{-- coluna 3 --}}
            <div class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white border-0">
              <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Atendimento
                Jurídico</span>
              {{-- Advogado --}}
              <a href="{{ route('lawyers.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Advogado</span>
              </a>
              {{-- Defensor Públic --}}
              <a href="{{ route('public-defender.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Defensor Público</span>
              </a>
              {{-- Tipo de Atendimento --}}
              <a href="{{ route('type-cares.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Tipo de Atendimento</span>
              </a>
              {{-- Modalidade do Atendimento --}}
              <a href="{{ route('modality-cares.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Modalidade do Atendimento</span>
              </a>
              {{-- Comarca --}}
              <a href="{{ route('districts.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Comarca</span>
              </a>
              {{-- Vara Criminal --}}
              <a href="{{ route('criminal-courts.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Vara Criminal</span>
              </a>

              {{-- --}}
              <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Familiares</span>
              {{-- Grau de Parentesco --}}
              <a href="{{ route('degrees-of-kinship.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Grau de Parentesco</span>
              </a>

              {{-- --}}
              <span class="flex justify-center font-semibold mb-1 underline text-blue-600">PAD</span>
              {{-- Tipos de Ocorrência --}}
              <a href="{{ route('pad-type-of-occurrences.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Tipos de Ocorrência</span>
              </a>
              {{-- Status da Ocorrência --}}
              <a href="{{ route('pad-statuses.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Status da Ocorrência</span>
              </a>
              {{-- Natureza da Ocorrência --}}
              <a href="{{ route('pad-nature-of-events.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Natureza da Ocorrência</span>
              </a>
              {{-- Local da Ocorrência --}}
              <a href="{{ route('pad-locals.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Local da Ocorrência</span>
              </a>
              {{-- Tipos de Evento --}}
              <a href="{{ route('pad-event-types.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Tipos de Evento</span>
              </a>
            </div>
          </div>
        </div>
      </li>
      @endcan

      {{-- Usuários --}}
      @can('admin')
      <li>
        <div x-data="{
                        open: false,
                        toggle() {
                            if (this.open) {
                                return this.close()
                            }
                            this.$refs.button.focus()
                            this.open = true
                        },
                        close(focusAfter) {
                            if (! this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
          x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

          <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button"
            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
            <div class="hidden sm:flex">
              <i data-lucide="circle-user" class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400"></i>
            </div>
            <span class="py-2">Usuários</span>
          </button>
          <div
            class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
            <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
              :id="$id('dropdown-button')" style="display: none;"
              class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white">
              {{-- Listar Usuário --}}
              <a href="{{ route('users-show.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Listar Usuário</span>
              </a>
              {{-- Nível de Acesso --}}
              <a href="{{ route('level-accesses.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Nível de Acesso</span>
              </a>
            </div>
          </div>
        </div>
      </li>
      @endcan

      {{-- Relatórios --}}
      @can('guest')
      <li>
        <div x-data="{
                        open: false,
                        toggle() {
                            if (this.open) {
                                return this.close()
                            }
                            this.$refs.button.focus()
                            this.open = true
                        },
                        close(focusAfter) {
                            if (! this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
          x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

          <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button"
            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
            <div class="hidden sm:flex">
              <i data-lucide="newspaper" class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400"></i>
            </div>
            <span class="py-2">Relatórios</span>
          </button>
          <div
            class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
            <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
              :id="$id('dropdown-button')" style="display: none;"
              class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white">
              {{-- Listagem de Presos --}}
              <a href="{{ route('prisoners-list.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Listagem de Presos</span>
              </a>

              {{-- VCAM --}}
              @can('admin')
              <a href="{{ route('vcam-list.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">VCAM</span>
              </a>
              @endcan

              {{-- Atendimentos Internos --}}
              @can('guest')
              <a href="{{ route('internal-services.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Atendimentos Internos</span>
              </a>
              @endcan

              {{-- Atendimentos Jurídicos --}}
              @can('guest')
              <a href="{{ route('legal-assistances.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Atendimentos Jurídicos</span>
              </a>
              @endcan

              {{-- Saídas Externas --}}
              @can('guest')
              <a href="{{ route('external-exits.index') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Saídas Externas</span>
              </a>
              @endcan
            </div>
          </div>
        </div>
      </li>
      @endcan

      {{-- Inforpen --}}
      @can('admin')
      <li>
        <div x-data="{
                        open: false,
                        toggle() {
                            if (this.open) {
                                return this.close()
                            }
                            this.$refs.button.focus()
                            this.open = true
                        },
                        close(focusAfter) {
                            if (! this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
          x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

          <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button"
            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
            <div class="hidden sm:flex">
              <i data-lucide="badge-info" class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400"></i>
            </div>
            <span class="py-2">Infopen</span>
          </button>
          <div
            class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
            <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
              :id="$id('dropdown-button')" style="display: none;"
              class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white">
              {{-- Atestado de Pena --}}
              <a href="{{ route('infopen.certificate-of-sentence') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Atestado de Pena</span>
              </a>
              {{-- Pena --}}
              <a href="{{ route('infopen.sentence') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Pena (Anos, Meses e Dias)</span>
              </a>
              {{-- Tipos Penais --}}
              <a href="{{ route('infopen.criminal-types') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Tipos Penais</span>
              </a>
              {{-- Prisons --}}
              <a href="{{ route('infopen.prisons') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Histórico de Prisões</span>
              </a>
              {{-- Processos --}}
              <a href="{{ route('infopen.processes') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Processos</span>
              </a>
              {{-- Tipos Penais --}}
              <a href="{{ route('infopen.type-prisons') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Tipo de Prisões</span>
              </a>
              {{-- Escolaridade --}}
              <a href="{{ route('infopen-education-level') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Escolaridade</span>
              </a>
              {{-- Prisoner --}}
              <a href="{{ route('infopen-prisoner') }}"
                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                <span class="">Preso</span>
              </a>
            </div>
          </div>
        </div>
      </li>
      @endcan
    </ul>
  </nav>


  {{-- <nav class="bg-white border-zinc-200 dark:bg-zinc-900 dark:border-zinc-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-center mx-auto p-4">
      <!-- Botão do Menu -->
      <button data-collapse-toggle="navbar-multi-level" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-zinc-500 rounded-lg md:hidden hover:bg-zinc-100 focus:outline-none focus:ring-2 focus:ring-zinc-200 dark:text-zinc-400 dark:hover:bg-zinc-700 dark:focus:ring-zinc-600"
        aria-controls="navbar-multi-level" aria-expanded="false">
        <span class="sr-only">Menu</span>
        <i data-lucide="align-justify" class="w-7 h-7 text-zinc-100 dark:text-zinc-400"></i>
      </button>

      <!-- Menu -->
      <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">
        <ul
          class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-zinc-100 rounded-lg bg-zinc-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-zinc-800 md:dark:bg-zinc-900 dark:border-zinc-700">

          <!-- Presos -->
          @can('admin-saude-guest')
          <li>
            <button id="prisonerLink" data-dropdown-toggle="prisoner"
              class="flex items-center justify-between w-full py-2 px-3 text-zinc-900 hover:bg-zinc-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:hover:bg-zinc-700 md:dark:hover:bg-transparent">
              <i data-lucide="circle-user" class="w-5 h-5 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
              Presos
              <i data-lucide="chevron-down" class="w-4 h-4 ms-2.5 text-zinc-100 dark:text-zinc-400"></i>
            </button>
            <!-- Dropdown menu -->
            <div id="prisoner"
              class="z-10 hidden font-normal bg-white divide-y divide-zinc-100 rounded-lg shadow-sm w-44 dark:bg-zinc-700 dark:divide-zinc-600">
              <ul class="py-2 text-sm text-zinc-700 dark:text-zinc-200" aria-labelledby="dropdownLargeButton">
                <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                  <a class="flex items-center" href="{{ route('prisoners.search') }}" wire:navigate>
                    <i data-lucide="search-x" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                    Pesquisar
                  </a>
                </li>
              </ul>
            </div>
          </li>
          @endcan

          <!-- Visitas -->
          @can('admin-recepcao-guest')
          <li>
            <button id="visitsLink" data-dropdown-toggle="visits"
              class="flex items-center justify-between w-full py-2 px-3 text-zinc-900 hover:bg-zinc-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:hover:bg-zinc-700 md:dark:hover:bg-transparent">
              <i data-lucide="baby" class="w-5 h-5 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
              Visitas
              <i data-lucide="chevron-down" class="w-4 h-4 ms-2.5 text-zinc-100 dark:text-zinc-400"></i>
            </button>
            <!-- Dropdown menu -->
            <div id="visits"
              class="z-10 hidden font-normal bg-white divide-y divide-zinc-100 rounded-lg shadow-sm w-72 dark:bg-zinc-700 dark:divide-zinc-600">
              <ul class="py-2 text-sm text-zinc-700 dark:text-zinc-200" aria-labelledby="dropdownLargeButton">
                <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                  <a class="flex items-center" href="{{ route('visitant.index') }}" wire:navigate>
                    <i data-lucide="users" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                    Visitante
                  </a>
                </li>
                <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                  <a class="flex items-center" href="{{ route('identification-card.index') }}" wire:navigate>
                    <i data-lucide="id-card" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                    Carteirinha
                  </a>
                </li>
                <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                  <a class="flex items-center" href="{{ route('visit-scheduling-date.index') }}" wire:navigate>
                    <i data-lucide="calendar-clock" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                    Periodo de Agendamento das Visitas
                  </a>
                </li>
                <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                  <a class="flex items-center" href="{{ route('visit-control.index') }}" wire:navigate>
                    <i data-lucide="file-sliders" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                    Controle de Visitas
                  </a>
                </li>
              </ul>
            </div>
          </li>
          @endcan

          <!-- Acessórios -->
          @can('admin')
          <li>
            <button id="acessoryLink" data-dropdown-toggle="acessory"
              class="flex items-center justify-between w-full py-2 px-3 text-zinc-900 hover:bg-zinc-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:hover:bg-zinc-700 md:dark:hover:bg-transparent">
              <i data-lucide="grid-2x2-plus" class="w-5 h-5 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
              Acessórios
              <i data-lucide="chevron-down" class="w-4 h-4 ms-2.5 text-zinc-100 dark:text-zinc-400"></i>
            </button>
            <!-- Dropdown menu -->
            <div id="acessory"
              class="z-10 hidden font-normal bg-white divide-y divide-zinc-100 rounded-lg shadow-sm w-66 dark:bg-zinc-700 dark:divide-zinc-600">
              <ul class="py-2 text-sm text-zinc-700 dark:text-zinc-200" aria-labelledby="dropdownLargeButton">
                <!-- Cadastros Gerais -->
                <li aria-labelledby="acessoryLink">
                  <button id="generalRegistrationDropdownButton" data-dropdown-toggle="generalRegistrationDropdown"
                    data-dropdown-placement="right-start" type="button"
                    class="flex items-center justify-between w-full px-4 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                    <div class="flex items-center">
                      <i data-lucide="notebook-pen" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                      Cadastros Gerais
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 ms-2.5 text-zinc-100 dark:text-zinc-400"></i>
                  </button>
                  <div id="generalRegistrationDropdown"
                    class="z-10 hidden bg-white divide-y divide-zinc-100 rounded-lg shadow-sm w-44 dark:bg-zinc-700">
                    <ul class="py-2 text-sm text-zinc-700 dark:text-zinc-200"
                      aria-labelledby="generalRegistrationDropdownButton">
                      <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                        <a class="flex items-center" href="{{ route('countries.index') }}" wire:navigate>
                          <i data-lucide="earth" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                          País
                        </a>
                      </li>
                      <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                        <a class="flex items-center" href="{{ route('states.index') }}" wire:navigate>
                          <i data-lucide="map-pin-house"
                            class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                          Estado
                        </a>
                      </li>
                      <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                        <a class="flex items-center" href="{{ route('municipalities.index') }}" wire:navigate>
                          <i data-lucide="webcam" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                          Município
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

                <!-- Cadastros da Unidade -->
                <li aria-labelledby="acessoryLink">
                  <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown"
                    data-dropdown-placement="right-start" type="button"
                    class="flex items-center justify-between w-full px-4 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                    <i data-lucide="clipboard-list" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                    Cadastros da Unidade
                    <i data-lucide="chevron-right" class="w-4 h-4 ms-2.5 text-zinc-100 dark:text-zinc-400"></i>
                  </button>
                  <div id="doubleDropdown"
                    class="z-10 hidden bg-white divide-y divide-zinc-100 rounded-lg shadow-sm w-44 dark:bg-zinc-700">
                    <ul class="py-2 text-sm text-zinc-700 dark:text-zinc-200" aria-labelledby="doubleDropdownButton">
                      <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                        <a class="flex items-center" href="{{ route('countries.index') }}" wire:navigate>
                          <i data-lucide="earth" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                          País
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

              </ul>
            </div>
          </li>
          @endcan

          <!-- Users -->
          @can('admin')
          <li>
            <button id="userLink" data-dropdown-toggle="user"
              class="flex items-center justify-between w-full py-2 px-3 text-zinc-900 hover:bg-zinc-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:hover:bg-zinc-700 md:dark:hover:bg-transparent">
              <i data-lucide="circle-user" class="w-5 h-5 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
              Usuários
              <i data-lucide="chevron-down" class="w-4 h-4 ms-2.5 text-zinc-100 dark:text-zinc-400"></i>
            </button>
            <!-- Dropdown menu -->
            <div id="user"
              class="z-10 hidden font-normal bg-white divide-y divide-zinc-100 rounded-lg shadow-sm w-44 dark:bg-zinc-700 dark:divide-zinc-600">
              <ul class="py-2 text-sm text-zinc-700 dark:text-zinc-200" aria-labelledby="dropdownLargeButton">
                <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                  <a class="flex items-center" href="{{ route('prisoners.search') }}" wire:navigate>
                    <i data-lucide="search-x" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                    Pesquisar
                  </a>
                </li>
              </ul>
            </div>
          </li>
          @endcan

          <!-- Reports -->
          @can('guest')
          <li>
            <button id="reportLink" data-dropdown-toggle="report"
              class="flex items-center justify-between w-full py-2 px-3 text-zinc-900 hover:bg-zinc-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:hover:bg-zinc-700 md:dark:hover:bg-transparent">
              <i data-lucide="newspaper" class="w-5 h-5 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
              Relatórios
              <i data-lucide="chevron-down" class="w-4 h-4 ms-2.5 text-zinc-100 dark:text-zinc-400"></i>
            </button>
            <!-- Dropdown menu -->
            <div id="report"
              class="z-10 hidden font-normal bg-white divide-y divide-zinc-100 rounded-lg shadow-sm w-44 dark:bg-zinc-700 dark:divide-zinc-600">
              <ul class="py-2 text-sm text-zinc-700 dark:text-zinc-200" aria-labelledby="dropdownLargeButton">
                <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                  <a class="flex items-center" href="{{ route('prisoners.search') }}" wire:navigate>
                    <i data-lucide="search-x" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                    Pesquisar
                  </a>
                </li>
              </ul>
            </div>
          </li>
          @endcan

          <!-- Infopen -->
          @can('admin')
          <li>
            <button id="infopenLink" data-dropdown-toggle="infopen"
              class="flex items-center justify-between w-full py-2 px-3 text-zinc-900 hover:bg-zinc-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:hover:bg-zinc-700 md:dark:hover:bg-transparent">
              <i data-lucide="badge-info" class="w-5 h-5 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
              Infopen
              <i data-lucide="chevron-down" class="w-4 h-4 ms-2.5 text-zinc-100 dark:text-zinc-400"></i>
            </button>
            <!-- Dropdown menu -->
            <div id="infopen"
              class="z-10 hidden font-normal bg-white divide-y divide-zinc-100 rounded-lg shadow-sm w-44 dark:bg-zinc-700 dark:divide-zinc-600">
              <ul class="py-2 text-sm text-zinc-700 dark:text-zinc-200" aria-labelledby="dropdownLargeButton">
                <li class="block py-2 hover:bg-zinc-100 dark:hover:bg-zinc-600 dark:hover:text-white">
                  <a class="flex items-center" href="{{ route('prisoners.search') }}" wire:navigate>
                    <i data-lucide="search-x" class="w-4 h-4 ms-2.5 mr-1 text-zinc-100 dark:text-zinc-400"></i>
                    Pesquisar
                  </a>
                </li>
              </ul>
            </div>
          </li>
          @endcan

        </ul>
      </div>
    </div>
  </nav> --}}
</div>