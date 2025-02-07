<form action="{{ route('feature.index' ) }}" method="get">
    @csrf
    <div class="flex items-center gap-2 justify-center px-2 pb-3 my-4 border-b border-blue-300 dark:border-blue-500 ">
        <div
            class="flex justify-center items-center gap-2 w-[30%] bg-gray-300 hover:bg-gray-200 dark:bg-zinc-600 dark:hover:bg-zinc-500 border-none rounded px-2">
            <i data-lucide="search" class="w-7 h-7 text-zinc-100 dark:text-zinc-200"></i>
            <input type="text" name='search' placeholder="Search..." class="w-full bg-transparent border-none" />
        </div>

        <!-- Btn Blue -->
        <button type="submit"
            class="flex items-center gap-1 font-medium rounded text-sm p-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <i data-lucide="search" class="p-1 w-7 h-7 text-zinc-100 dark:text-zinc-200"></i>
        </button>
    </div>
</form>