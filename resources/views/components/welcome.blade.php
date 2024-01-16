<div class="p-6 lg:p-8 w-full flex-col">
    <div class="flex justify-center ">
        <x-application-logo class="w-1/4 pt-16" />
    </div>
    <p class="text-zinc-600 dark:text-zinc-300 text-center text-lg mt-4">{{ Auth::user()->email }}</p>
</div>