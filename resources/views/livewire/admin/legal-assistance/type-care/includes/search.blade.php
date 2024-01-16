<div id="search-box" class="flex flex-col items-center px-2 my-4 justify-center w-full border-b border-blue-300 dark:border-blue-500 pb-3">
    <div class="flex justify-center items-center w-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
        <input wire:model.live.debounce.500ms='search' type="text" placeholder="Search..." class="bg-gray-300 w-2/6 hover:bg-gray-200 dark:bg-zinc-600 dark:hover:bg-zinc-500 ml-2 border-none rounded px-4 py-2" />
    </div>
</div>