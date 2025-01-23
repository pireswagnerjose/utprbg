<div class="min-h-screen p-16 sm:p-0 flex flex-col gap-4 justify-center items-center bg-zinc-100 dark:bg-zinc-900">
    <div class="flex items-center">
        {{ $logo }}
    </div>

    <div class="w-full sm:w-[500px] p-8 bg-white dark:bg-zinc-800 shadow-md rounded-lg">
        {{ $slot }}
    </div>
</div>