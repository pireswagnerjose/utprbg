<x-app-layout class="">
    <div class="flex flex-col justify-center items-center h-[calc(100vh-15.75rem)]">
        <img src="{{ asset('storage/site/policia_penal_logo.svg') }}" alt="Logo da Polícia Penal" class='w-48'>
        <p class="text-zinc-600 dark:text-zinc-300 text-center text-lg mt-4">{{ Auth::user()->email }}</p>
    </div>
</x-app-layout>