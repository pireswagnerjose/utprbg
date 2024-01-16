{{-- menu --}}
<nav class="flex justify-center mt-3 border-t bg-zinc-500 dark:bg-zinc-700 border-zinc-400 dark:border-zinc-800">
    <ul class="flex font-medium md:flex-row md:space-x-4 md:mt-0">

        {{-- presos --}}
        <li>
            <button id="presos-button" data-dropdown-toggle="presos" class="flex items-center justify-between w-full text-sm font-medium text-zinc-100 md:w-auto hover:bg-zinc-50 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-zinc-700">
                <svg class="w-4 h-4 mr-2 pl-2 text-zinc-100 dark:text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.5 8V4.5a3.5 3.5 0 1 0-7 0V8M8 12v3M2 8h12a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1Z" />
                </svg>
                <span class="py-2">Presos</span>
                <svg class="w-2.5 h-2.5 ml-2 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="presos" class="absolute z-10 hidden w-auto text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                <div class="p-4 pb-0 text-zinc-900 md:pb-4 dark:text-white">
                    <ul class="space-y-4" aria-labelledby="presos-button">
                        {{-- Cadastro de preso --}}
                        @can('admin-cartorio_admin-cartorio_user')
                            <li>
                                <a href="{{ route('prisoners.create') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="sr-only">Cadastrar</span>
                                    Cadastrar
                                </a>
                            </li>
                        @endcan

                        {{-- pesquisa de preso --}}
                        <li>
                            <a href="{{ route('prisoners.index') }}"
                                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="sr-only">Pesquisar</span>
                                Pesquisar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>

        {{-- Tabelas Acessórias --}}
        @can('admin-cartorio_admin')
            <li>
                <button id="tabelas-acessorias-button" data-dropdown-toggle="tabelas-acessorias" class="flex items-center justify-between w-full text-sm font-medium text-zinc-100 md:w-auto hover:bg-zinc-50 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-zinc-700">
                    <svg class="w-4 h-4 mr-2 pl-2 text-zinc-100 dark:text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.5 8V4.5a3.5 3.5 0 1 0-7 0V8M8 12v3M2 8h12a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1Z" />
                    </svg>
                    <span class="py-2">Tabelas Acessórias</span>
                    <svg class="w-2.5 h-2.5 ml-2 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <div id="tabelas-acessorias"
                    class="absolute z-10 hidden grid grid-cols-4 w-auto text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 dark:bg-zinc-700">
                    <div
                        class="p-4 pb-0 text-zinc-900 md:pb-4 dark:text-white border-0 border-r border-zinc-200 dark:border-zinc-600">
                        {{-- coluna 1 --}}
                        <span class="flex items-center font-semibold mb-1 underline text-blue-600">Cadastros Gerais</span>
                        <ul class="space-y-2" aria-labelledby="tabelas-acessorias-button">
                            <li>
                                <a href="{{ route('countries.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">País</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('states.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Estado</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('municipalities.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Município</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('prison-units.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Unidade Prisional</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('education-levels.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Escolaridade</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('civil-statuses.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Estado Civil</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ethnicities.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Etnia</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sexual-orientations.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Orientação Sexual</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sexes.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Sexo</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    {{-- coluna 2 --}}
                    <div
                        class="p-4 pb-0 text-zinc-900 md:pb-4 dark:text-white border-0 border-r border-zinc-200 dark:border-zinc-600">
                        <span class="flex items-center font-semibold mb-1 underline text-blue-600">Cadastros da Unidade</span>
                        <ul class="space-y-2" aria-labelledby="tabelas-acessorias-button">
                            <li>
                                <a href="#" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Viaturas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('wards.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Ala (Pavilhão)</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cells.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Cela</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    {{-- coluna 3 --}}
                    <div class="p-4 pb-0 text-zinc-900 md:pb-4 dark:text-white border-0 border-r border-zinc-200 dark:border-zinc-600">
                        <span class="flex items-center font-semibold mb-1 underline text-blue-600">Prisões</span>
                        <ul class="space-y-2" aria-labelledby="tabelas-acessorias-button">
                            <li>
                                <a href="{{ route('prison-origins.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Origem da Prisão</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('type-prisons.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Tipo da Prisão</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('status-prisons.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Status da Prisão</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('output-types.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Tipo da Saída</span>
                                </a>
                            </li>
                        </ul>

                        <span class="flex items-center font-semibold mb-1 mt-4 underline text-blue-600">Processos</span>
                        <ul class="space-y-2" aria-labelledby="tabelas-acessorias-button">
                            <li>
                                <a href="{{ route('penal-types.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Tipo Penal</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('origin-processes.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Origem do Processo</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('process-regimes.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Regime do Processo</span>
                                </a>
                            </li>
                        </ul>

                        <span class="flex items-center font-semibold mb-1 mt-4 underline text-blue-600">Atendimentos Internos</span>
                        <ul class="space-y-2" aria-labelledby="tabelas-acessorias-button">
                            <li>
                                <a href="{{ route('type-services.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Tipo de Atendimento Interno</span>
                                </a>
                            </li>
                        </ul>

                        <span class="flex items-center font-semibold mb-1 mt-4 underline text-blue-600">Saídas Externas</span>
                        <ul class="space-y-2" aria-labelledby="tabelas-acessorias-button">
                            <li>
                                <a href="{{ route('requestings.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Requisitante</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('exit-reasons.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Motivo da Saída</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    {{-- coluna 4 --}}
                    <div class="p-4 pb-0 text-zinc-900 md:pb-4 dark:text-white">
                        <span class="flex items-center font-semibold mb-1 underline text-blue-600">Tabelas de Atendimento Jurídico</span>
                        <ul class="space-y-2" aria-labelledby="tabelas-acessorias-button">
                            <li>
                                <a href="{{ route('lawyers.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Advogado</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('type-cares.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Tipo de Atendimento</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('modality-cares.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Modalidade do Atendimento</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('districts.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Comarca</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('criminal-courts.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Vara Criminal</span>
                                </a>
                            </li>
                        </ul>
                        <span class="flex items-center font-semibold mb-1 mt-4 underline text-blue-600">Tabelas de Familiares</span>
                        <ul class="space-y-2" aria-labelledby="tabelas-acessorias-button">
                            <li>
                                <a href="{{ route('degrees-of-kinship.index') }}"
                                    class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Grau de Parentesco</span>
                                </a>
                            </li>
                        </ul>

                        <span class="flex items-center font-semibold mb-1 mt-4 underline text-blue-600">Tabelas do PAD</span>
                        <ul class="space-y-2" aria-labelledby="tabelas-acessorias-button">
                            <li>
                                <a href="{{ route('pad-type-of-occurrences.index') }}"
                                    class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Tipos de Ocorrências</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pad-statuses.index') }}"
                                    class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Status da Ocorrências</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pad-nature-of-events.index') }}"
                                    class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Natureza da Ocorrências</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pad-locals.index') }}"
                                    class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Local da Ocorrências</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pad-event-types.index') }}"
                                    class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Tipo da Ocorrências</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        @endcan

        {{-- Usuários --}}
        @can('admin')
            <li>
                <button id="usuarios-button" data-dropdown-toggle="usuarios" class="flex items-center justify-between w-full text-sm font-medium text-zinc-100 md:w-auto hover:bg-zinc-50 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-zinc-700">
                    <svg class="w-4 h-4 mr-2 pl-2 text-zinc-100 dark:text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.5 8V4.5a3.5 3.5 0 1 0-7 0V8M8 12v3M2 8h12a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1Z" />
                    </svg>
                    <span class="py-2">Usuários</span>
                    <svg class="w-2.5 h-2.5 ml-2 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <div id="usuarios"
                    class="absolute z-10 hidden w-auto text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                    <div class="p-4 pb-0 text-zinc-900 md:pb-4 dark:text-white">
                        <ul class="space-y-4" aria-labelledby="usuarios-button">
                            <li>
                                <a href="{{ route('users.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Listar Usuário</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('level-accesses.index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Nível de Acesso</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        @endcan

        {{-- Relatórios --}}
        <li>
            <button id="relatorios-button" data-dropdown-toggle="relatorios" class="flex items-center justify-between w-full text-sm font-medium text-zinc-100 md:w-auto hover:bg-zinc-50 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-zinc-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-zinc-700">
                <svg class="w-4 h-4 mr-2 pl-2 text-zinc-100 dark:text-zinc-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.5 8V4.5a3.5 3.5 0 1 0-7 0V8M8 12v3M2 8h12a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1Z" />
                </svg>
                <span class="py-2">Relatórios</span>
                <svg class="w-2.5 h-2.5 ml-2 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="relatorios"
                class="absolute z-10 hidden w-auto text-sm bg-white border border-zinc-100 rounded-lg shadow-md dark:border-zinc-700 md:grid-cols-3 dark:bg-zinc-700">
                <div class="p-4 pb-0 text-zinc-900 md:pb-4 dark:text-white">
                    <ul class="space-y-4" aria-labelledby="relatorios-button">
                        @can('todos_menos_recepcao')
                            <li>
                                <a href="{{ route('listings-report-index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Listagem dos Presos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('conferences-report-index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Conferência dos Presos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('internal-services-index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Atendimentos Internos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('legal-assistances-index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Atendimentos Jurídicos</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('external-exits-report-index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                    <span class="">Saídas Externas</span>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{ route('booking-visits-report-index') }}" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Visitas Agendadas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</nav>
