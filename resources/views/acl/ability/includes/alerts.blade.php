@if (session('success'))
<div id="alert-3"
    class="flex items-center shadow-lg p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-zinc-800 dark:text-green-400"
    role="alert">
    <i data-lucide="badge-info" class="w-5 h-5 text-zinc-400 dark:text-zinc-500"></i>

    <div class="ms-3 text-sm font-medium">
        {{ session('success') }}
    </div>
</div>
@elseif (session('error'))
<div id="alert-2"
    class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-zinc-800 dark:text-red-400"
    role="alert">
    <i data-lucide="badge-info" class="w-5 h-5 text-zinc-400 dark:text-zinc-500"></i>

    <div class="ms-3 text-sm font-medium">
        {{ session('error') }}
    </div>
</div>
@endif