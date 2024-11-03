<nav class="flex justify-center border-t bg-zinc-500 dark:bg-zinc-700 border-zinc-400 dark:border-zinc-800">
    <ul class="flex font-medium md:flex-row md:space-x-4 md:mt-0">
        {{-- presos --}}
        @can('admin-saude-guest')
            <li>
                <div
                    x-data="{
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
                    }"
                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                    x-id="['dropdown-button']" >

                    <button
                        x-ref="button"
                        x-on:click="toggle()"
                        :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')"
                        type="button"
                        class="flex items-center justify-between w-full text-sm font-medium text-zinc-100 md:w-auto hover:bg-zinc-50 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-zinc-700">
                        @include('icons.bars-arrow-down')
                        <span class="py-2">Presos</span>
                    </button>
                    <div class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                        <div 
                            x-ref="panel"
                            x-show="open"
                            x-transition.origin.top.left
                            x-on:click.outside="close($refs.button)"
                            :id="$id('dropdown-button')"
                            style="display: none;"
                            class="p-4 pb-0 space-y-2 text-zinc-900 md:pb-4 dark:text-white">
                            
                            {{-- pesquisa de preso --}}
                            <a href="{{ route('prisoners.search') }}" wire:navigate class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
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
                <div
                    x-data="{
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
                    }"
                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                    x-id="['dropdown-button']">

                    <button 
                        x-ref="button"
                        x-on:click="toggle()"
                        :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')"
                        type="button"
                        class="flex items-center justify-between w-full text-sm font-medium text-zinc-100 md:w-auto hover:bg-zinc-50 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-zinc-700">
                        @include('icons.bars-arrow-down')
                        <span class="py-2">Visitantes</span>
                    </button>
                    <div class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                        <div
                            x-ref="panel"
                            x-show="open"
                            x-transition.origin.top.left
                            x-on:click.outside="close($refs.button)"
                            :id="$id('dropdown-button')"
                            style="display: none;"
                            class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white" >
                            {{-- Pesquisar Visitante --}}
                            <a href="{{ route('visitant.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Pesquisar Visitante</span>
                            </a>

                            {{-- Cadastro de preso --}}
                            @can('admin-recepcao')
                                <a href="{{ route('identification-card.index') }}" wire:navigate class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    Carteirinha
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
                <div
                    x-data="{
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
                    }"
                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                    x-id="['dropdown-button']"
                    class="grid justify-items-center">

                    <button
                        x-ref="button"
                        x-on:click="toggle()"
                        :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')"
                        type="button"
                        class="flex items-center justify-between w-full text-sm font-medium text-zinc-100 md:w-auto hover:bg-zinc-50 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-zinc-700">
                        @include('icons.bars-arrow-down')
                        <span class="py-2">Tabelas Acessórias</span>
                    </button>
                    <div
                        x-ref="panel"
                        x-show="open"
                        x-transition.origin.top.left
                        x-on:click.outside="close($refs.button)"
                        :id="$id('dropdown-button')"
                        style="display: none;"
                        class="absolute z-10 grid grid-cols-3 mt-10 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 dark:bg-zinc-700">
                        
                        {{-- coluna 1 --}}
                        <div class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white border-0 border-r border-zinc-200 dark:border-zinc-600">
                            <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Cadastros Gerais</span>
                            {{-- País --}}
                            <a href="{{ route('countries.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">País</span>
                            </a>
                            {{-- Estado --}}
                            <a href="{{ route('states.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Estado</span>
                            </a>
                            {{-- Município --}}
                            <a href="{{ route('municipalities.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Município</span>
                            </a>
                            {{-- Unidade Prisional --}}
                            <a href="{{ route('prison-units.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Unidade Prisional</span>
                            </a>
                            {{-- Escolaridade --}}
                            <a href="{{ route('education-levels.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Escolaridade</span>
                            </a>
                            {{-- Estado Civil --}}
                            <a href="{{ route('civil-statuses.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Estado Civil</span>
                            </a>
                            {{-- Etnia --}}
                            <a href="{{ route('ethnicities.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Etnia</span>
                            </a>
                            {{-- Orientação Sexual --}}
                            <a href="{{ route('sexual-orientations.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Orientação Sexual</span>
                            </a>
                            {{-- Sexo --}}
                            <a href="{{ route('sexes.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Sexo</span>
                            </a>

                            <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Cadastros da Unidade</span>
                            {{-- Viaturas --}}
                            <a href="#" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Viaturas</span>
                            </a>
                            {{-- Ala (Pavilhão) --}}
                            <a href="{{ route('wards.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Ala (Pavilhão)</span>
                            </a>
                            {{-- Cela --}}
                            <a href="{{ route('cells.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Cela</span>
                            </a>
                        </div>

                        {{-- coluna 2 --}}
                        <div class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white border-0 border-r border-zinc-200 dark:border-zinc-600">
                            <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Prisões</span>
                            {{-- Origem da Prisão --}}
                            <a href="{{ route('prison-origins.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Origem da Prisão</span>
                            </a>
                            {{-- Tipo da Prisão --}}
                            <a href="{{ route('type-prisons.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Tipo da Prisão</span>
                            </a>
                            {{-- Status da Prisão --}}
                            <a href="{{ route('status-prisons.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Status da Prisão</span>
                            </a>
                            {{-- Tipo da Saída --}}
                            <a href="{{ route('output-types.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Tipo da Saída</span>
                            </a>

                            {{--  --}}
                            <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Processos</span>
                            {{-- Tipo Penal --}}
                            <a href="{{ route('penal-types.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Tipo Penal</span>
                            </a>
                            {{-- Origem do Processo --}}
                            <a href="{{ route('origin-processes.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Origem do Processo</span>
                            </a>
                            {{-- Regime do Processo --}}
                            <a href="{{ route('process-regimes.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Regime do Processo</span>
                            </a>

                            {{--  --}}
                            <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Atendimentos Internos</span>
                            {{-- Tipo de Atendimento Interno --}}
                            <a href="{{ route('type-services.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Tipo de Atendimento Interno</span>
                            </a>
                            
                            {{--  --}}
                            <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Saídas Externas</span>
                            {{-- Requisitante --}}
                            <a href="{{ route('requestings.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Requisitante</span>
                            </a>
                            {{-- Motivo da Saída --}}
                            <a href="{{ route('exit-reasons.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Motivo da Saída</span>
                            </a>
                        </div>

                        {{-- coluna 3 --}}
                        <div class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white border-0">
                            <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Atendimento Jurídico</span>
                            {{-- Advogado --}}
                            <a href="{{ route('lawyers.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Advogado</span>
                            </a>
                            {{-- Defensor Públic --}}
                            <a href="{{ route('public-defender.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Defensor Público</span>
                            </a>
                            {{-- Tipo de Atendimento --}}
                            <a href="{{ route('type-cares.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Tipo de Atendimento</span>
                            </a>
                            {{-- Modalidade do Atendimento --}}
                            <a href="{{ route('modality-cares.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Modalidade do Atendimento</span>
                            </a>
                            {{-- Comarca --}}
                            <a href="{{ route('districts.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Comarca</span>
                            </a>
                            {{-- Vara Criminal --}}
                            <a href="{{ route('criminal-courts.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Vara Criminal</span>
                            </a>

                            {{--  --}}
                            <span class="flex justify-center font-semibold mb-1 underline text-blue-600">Familiares</span>
                            {{-- Grau de Parentesco --}}
                            <a href="{{ route('degrees-of-kinship.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Grau de Parentesco</span>
                            </a>

                            {{--  --}}
                            <span class="flex justify-center font-semibold mb-1 underline text-blue-600">PAD</span>
                            {{-- Tipos de Ocorrência --}}
                            <a href="{{ route('pad-type-of-occurrences.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Tipos de Ocorrência</span>
                            </a>
                            {{-- Status da Ocorrência --}}
                            <a href="{{ route('pad-statuses.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Status da Ocorrência</span>
                            </a>
                            {{-- Natureza da Ocorrência --}}
                            <a href="{{ route('pad-nature-of-events.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Natureza da Ocorrência</span>
                            </a>
                            {{-- Local da Ocorrência --}}
                            <a href="{{ route('pad-locals.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Local da Ocorrência</span>
                            </a>
                            {{-- Tipos de Evento --}}
                            <a href="{{ route('pad-event-types.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
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
                <div
                    x-data="{
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
                    }"
                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                    x-id="['dropdown-button']">

                    <button 
                        x-ref="button"
                        x-on:click="toggle()"
                        :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')"
                        type="button"
                        class="flex items-center justify-between w-full text-sm font-medium text-zinc-100 md:w-auto hover:bg-zinc-50 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-zinc-700">
                        @include('icons.bars-arrow-down')
                        <span class="py-2">Usuários</span>
                    </button>
                    <div class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                        <div
                            x-ref="panel"
                            x-show="open"
                            x-transition.origin.top.left
                            x-on:click.outside="close($refs.button)"
                            :id="$id('dropdown-button')"
                            style="display: none;"
                            class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white" >
                            {{-- Listar Usuário --}}
                            <a href="{{ route('users-show.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Listar Usuário</span>
                            </a>
                            {{-- Nível de Acesso --}}
                            <a href="{{ route('level-accesses.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
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
                <div
                    x-data="{
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
                    }"
                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                    x-id="['dropdown-button']">

                    <button 
                        x-ref="button"
                        x-on:click="toggle()"
                        :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')"
                        type="button"
                        class="flex items-center justify-between w-full text-sm font-medium text-zinc-100 md:w-auto hover:bg-zinc-50 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-zinc-700">
                        @include('icons.bars-arrow-down')
                        <span class="py-2">Relatórios</span>
                    </button>
                    <div class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                        <div
                            x-ref="panel"
                            x-show="open"
                            x-transition.origin.top.left
                            x-on:click.outside="close($refs.button)"
                            :id="$id('dropdown-button')"
                            style="display: none;"
                            class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white" >
                            {{-- Listagem de Presos --}}
                            <a href="{{ route('prisoners-list.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Listagem de Presos</span>
                            </a>

                            {{-- VCAM --}}
                            @can('admin')
                                <a href="{{ route('vcam-list.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">VCAM</span>
                                </a>
                            @endcan

                            {{-- Atendimentos Internos --}}
                            @can('guest')
                                <a href="{{ route('internal-services.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Atendimentos Internos</span>
                                </a>
                            @endcan

                            {{-- Atendimentos Jurídicos --}}
                            @can('guest')
                                <a href="{{ route('legal-assistances.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Atendimentos Jurídicos</span>
                                </a>
                            @endcan

                            {{-- Saídas Externas --}}
                            @can('guest')
                                <a href="{{ route('external-exits.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
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
                <div
                    x-data="{
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
                    }"
                    x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                    x-id="['dropdown-button']">

                    <button 
                        x-ref="button"
                        x-on:click="toggle()"
                        :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')"
                        type="button"
                        class="flex items-center justify-between w-full text-sm font-medium text-zinc-100 md:w-auto hover:bg-zinc-50 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-zinc-700">
                        @include('icons.bars-arrow-down')
                        <span class="py-2">Infopen</span>
                    </button>
                    <div class="absolute z-10 w-auto mt-1 text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                        <div
                            x-ref="panel"
                            x-show="open"
                            x-transition.origin.top.left
                            x-on:click.outside="close($refs.button)"
                            :id="$id('dropdown-button')"
                            style="display: none;"
                            class="p-4 pb-0 space-y-1 text-zinc-900 md:pb-4 dark:text-white" >
                            {{-- Atestado de Pena --}}
                            <a href="{{ route('infopen.certificate-of-sentence') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Atestado de Pena</span>
                            </a>
                            {{-- Pena --}}
                            <a href="{{ route('infopen.sentence') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Pena (Anos, Meses e Dias)</span>
                            </a>
                            {{-- Tipos Penais --}}
                            <a href="{{ route('infopen.criminal-types') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Tipos Penais</span>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        @endcan
    </ul>
</nav>
