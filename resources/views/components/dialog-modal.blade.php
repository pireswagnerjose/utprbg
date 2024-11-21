@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="text-lg font-medium py-3 bg-gradient-to-b from-blue-600 to-blue-700 shadow-lg text-center text-blue-300 uppercase">
        {{ $title }}
    </div>
    
    <div class="px-6 py-4">
        <div class="mt-4 text-sm text-zinc-600 dark:text-zinc-400">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-zinc-200 dark:bg-zinc-900 text-end">
        {{ $footer }}
    </div>
</x-modal>
