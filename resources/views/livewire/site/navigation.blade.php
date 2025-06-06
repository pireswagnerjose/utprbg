<div>
    <nav>
        <ul class="flex flex-row sm:flex-row px-8 gap-4 justify-center items-center bg-zinc-500 dark:bg-zinc-700">
            {{-- presos --}}
            @can('show_menu_prisoner')
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
                            if (!this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                        x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')" type="button"
                            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
                            <div class="hidden sm:flex">
                                <x-lucide-user
                                    class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400"></x-lucide-user>
                            </div>
                            <span class="py-2">Presos</span>
                        </button>
                        <div
                            class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                            <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" style="display: none;"
                                class="p-4 pb-0 space-y-2 text-zinc-900 md:pb-4 dark:text-white">

                                {{-- pesquisa de preso --}}
                                @can('show_prisoners')
                                    <a href="{{ route('prisoners.search') }}" wire:navigate
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        Pesquisar
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </li>
            @endcan

            {{-- Visitantes --}}
            @can('show_menu_visitants')
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
                            if (!this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                        x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')" type="button"
                            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
                            <div class="hidden sm:flex">
                                <x-lucide-baby
                                    class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400"></x-lucide-baby>
                            </div>
                            <span class="py-2">Visitas</span>
                        </button>
                        <div
                            class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                            <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" style="display: none;"
                                class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white">
                                {{-- Página de Gerenciamento do Visitante --}}
                                @can('show_visitant')
                                    <a href="{{ route('visitant.index') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Visitante</span>
                                    </a>
                                @endcan

                                {{-- Gerenciamento da Carteirinha do Visitante --}}
                                @can('show_identification_card')
                                    <a href="{{ route('identification-card.index') }}" wire:navigate
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        Carteirinha
                                    </a>
                                @endcan

                                {{-- Periodo de Agendamento das Visitas --}}
                                @can('show_visit_scheduling_date')
                                    <a href="{{ route('visit-scheduling-date.index') }}" wire:navigate
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        Periodo de Agendamento das Visitas
                                    </a>
                                @endcan

                                {{-- Controle de Visitas --}}
                                @can('show_visit_control')
                                    <a href="{{ route('visit-control.index') }}" wire:navigate
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        Controle de Visitas
                                    </a>
                                @endcan

                                {{-- Visitas Agendadas --}}
                                @can('show_visit_scheduling')
                                    <a href="{{ route('visit-report.index') }}" wire:navigate
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        Visitas Agendadas
                                    </a>
                                @endcan
                                {{-- Visitas Agendadas do dia --}}
                                @can('show_visit_scheduling')
                                    <a href="{{ route('scheduled-visit-of-the-day.index') }}" wire:navigate
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        Visitas Agendadas do Dia
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </li>
            @endcan

            {{-- advogados --}}
            @can('show_menu_lawyer')
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
                            if (!this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                        x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')" type="button"
                            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
                            <div class="hidden sm:flex">
                                <x-lucide-scale
                                    class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400"></x-lucide-scale>
                            </div>
                            <span class="py-2">Advogados</span>
                        </button>
                        <div
                            class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                            <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" style="display: none;"
                                class="p-4 pb-0 space-y-2 text-zinc-900 md:pb-4 dark:text-white">

                                {{-- pesquisa de advogado --}}
                                @can('search_lawyer')
                                    <a href="{{ route('lawyers.index') }}" wire:navigate
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        Pesquisar
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </li>
            @endcan

            {{-- tabelas acessórias --}}
            @can('show_menu_acessories')
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
                            if (!this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                        x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
                        class="grid justify-items-center">

                        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')" type="button"
                            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
                            <div class="hidden sm:flex">
                                <x-lucide-grid-2x2
                                    class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400"></x-lucide-grid-2x2>
                            </div>
                            <span class="py-2">Acessórios</span>
                        </button>
                        <div x-ref="panel" x-show="open" x-transition.origin.top.left
                            x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" style="display: none;"
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
                                <span
                                    class="flex justify-center font-semibold mb-1 underline text-blue-600">Processos</span>
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
                                <span
                                    class="flex justify-center font-semibold mb-1 underline text-blue-600">Familiares</span>
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
            @can('show_menu_users')
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
                            if (!this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                        x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')" type="button"
                            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
                            <div class="hidden sm:flex">
                                <x-lucide-circle-user class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400">
                                </x-lucide-circle-user>
                            </div>
                            <span class="py-2">Usuários</span>
                        </button>
                        <div
                            class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                            <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                                style="display: none;" class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white">
                                {{-- Listar Usuário --}}
                                <a href="{{ route('users-show.index') }}"
                                    class="flex gap-1 items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <x-lucide-layout-list
                                        class="w-3 h-3 text-zinc-400 dark:text-zinc-500"></x-lucide-layout-list>
                                    <span class="">Listar Usuário</span>
                                </a>

                                {{-- Nível de Acesso --}}
                                <a href="{{ route('role.index') }}"
                                    class="flex gap-1 items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <x-lucide-circle-arrow-out-up-left class="w-3 h-3 text-zinc-400 dark:text-zinc-500">
                                    </x-lucide-circle-arrow-out-up-left>
                                    <span class="">Nível de Acesso</span>
                                </a>

                                {{-- Nível de Acesso --}}
                                <a href="{{ route('feature.index') }}"
                                    class="flex gap-1 items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <x-lucide-radar class="w-3 h-3 text-zinc-400 dark:text-zinc-500"></x-lucide-radar>
                                    <span class="">Funcionalidade</span>
                                </a>

                                {{-- Nível de Acesso --}}
                                <a href="{{ route('ability.index') }}"
                                    class="flex gap-1 items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <x-lucide-case-upper
                                        class="w-3 h-3 text-zinc-400 dark:text-zinc-500"></x-lucide-case-upper>
                                    <span class="">Permissões do Usuário</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @endcan

            {{-- Relatórios --}}
            @can('show_menu_report')
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
                            if (!this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                        x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')" type="button"
                            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
                            <div class="hidden sm:flex">
                                <x-lucide-newspaper
                                    class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400"></x-lucide-newspaper>
                            </div>
                            <span class="py-2">Relatórios</span>
                        </button>
                        <div
                            class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                            <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                                style="display: none;" class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white">
                                {{-- Listagem de Presos --}}
                                @can('prisoners_listing')
                                    <a href="{{ route('prisoners-list.index') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Listagem de Presos</span>
                                    </a>
                                @endcan

                                {{-- VCAM --}}
                                @can('vcam')
                                    <a href="{{ route('vcam-list.index') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">VCAM</span>
                                    </a>
                                @endcan

                                {{-- Atendimentos Internos --}}
                                @can('internal_services')
                                    <a href="{{ route('internal-services.index') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Atendimentos Internos</span>
                                    </a>
                                @endcan

                                {{-- Atendimentos Jurídicos --}}
                                @can('legal_assistances')
                                    <a href="{{ route('legal-assistances.index') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Atendimentos Jurídicos</span>
                                    </a>
                                @endcan

                                {{-- Saídas Externas --}}
                                @can('external_exits')
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
            @can('show_menu_infopen')
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
                            if (!this.open) return
                            this.open = false
                            focusAfter && focusAfter.focus()
                        }
                    }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                        x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                            :aria-controls="$id('dropdown-button')" type="button"
                            class="flex items-center gap-1 text-sm font-medium text-zinc-100 dark:text-zinc-200 hover:text-blue-500 dark:hover:text-blue-500">
                            <div class="hidden sm:flex">
                                <x-lucide-badge-info class="w-4 h-4 hidden sm:flex text-zinc-100 dark:text-zinc-400">
                                </x-lucide-badge-info>
                            </div>
                            <span class="py-2">Infopen</span>
                        </button>
                        <div
                            class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                            <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                                style="display: none;" class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white">
                                {{-- Atestado de Pena --}}
                                @can('infopen_certificate_of_sentence')
                                    <a href="{{ route('infopen.certificate-of-sentence') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Atestado de Pena</span>
                                    </a>
                                @endcan

                                {{-- Pena --}}
                                @can('infopen_sentence')
                                    <a href="{{ route('infopen.sentence') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Pena (Anos, Meses e Dias)</span>
                                    </a>
                                @endcan

                                {{-- Tipos Penais --}}
                                @can('infopen_criminal_types')
                                    <a href="{{ route('infopen.criminal-types') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Tipos Penais</span>
                                    </a>
                                @endcan

                                {{-- Prisons --}}
                                @can('infopen_prisons')
                                    <a href="{{ route('infopen.prisons') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Histórico de Prisões</span>
                                    </a>
                                @endcan

                                {{-- Processos --}}
                                @can('infopen_processes')
                                    <a href="{{ route('infopen.processes') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Processos</span>
                                    </a>
                                @endcan

                                {{-- Tipos Penais --}}
                                @can('infopen_type_prisons')
                                    <a href="{{ route('infopen.type-prisons') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Tipos de Prisões</span>
                                    </a>
                                @endcan

                                {{-- Escolaridade --}}
                                @can('infopen_education_level')
                                    <a href="{{ route('infopen-education-level') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Escolaridade</span>
                                    </a>
                                @endcan

                                {{-- Prisoner --}}
                                @can('infopen_prisoner')
                                    <a href="{{ route('infopen-prisoner') }}"
                                        class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                        <span class="">Presos</span>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </li>
            @endcan
        </ul>
    </nav>
</div>
