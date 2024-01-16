<div class="min-h-screen flex flex-row sm:justify-center items-center pt-6 sm:pt-0 bg-zinc-100 dark:bg-zinc-900">
    <div class="flex items-center h-72 mt-6 px-6 py-4 mr-1 bg-white dark:bg-zinc-800 shadow-md overflow-hidden sm:rounded-s-lg -lg">
        {{ $logo }}
    </div>

    <div class="w-1/5 h-72 mt-6 px-6 py-4 bg-white dark:bg-zinc-800 shadow-md overflow-hidden sm:rounded-e-lg">
        {{ $slot }}
    </div>
</div>
