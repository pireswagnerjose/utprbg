{{-- menu --}}
<nav class="flex justify-center border-t bg-zinc-500 dark:bg-zinc-700 border-zinc-400 dark:border-zinc-800">
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
                        <li>
                            <a href="#" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="sr-only">Cadastrar</span>
                                Cadastrar
                            </a>
                        </li>
                        
                        {{-- pesquisa de preso --}}
                        <li>
                            <a href="#"
                                class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="sr-only">Pesquisar</span>
                                Pesquisar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>

        

        {{-- Usuários --}}
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
                            <a href="#" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Listar Usuário</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-zinc-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                <span class="">Nível de Acesso</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</nav>
