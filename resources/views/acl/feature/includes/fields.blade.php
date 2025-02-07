<div class="mb-6 flex flex-col gap-6">
    <div class="relative z-0 w-full group">
        <div>
            <label for="title" class="block mb-1 text-xs font-light text-zinc-900 dark:text-white">
                Título
            </label>
            <input type="text" id="title" name="title" value="{{ old('title', $feature->title ?? '') }}"
                class="shadow-xs bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="Título" />
        </div>
        @error('title')
        <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>
    <div class="relative z-0 w-full group">
        <div>
            <label for="functionality" class="block mb-1 text-xs font-light text-zinc-900 dark:text-white">
                Funcioanlidade
            </label>
            <input type="text" id="functionality" name="functionality"
                value="{{ old('functionality', $feature->functionality ?? '') }}"
                class="shadow-xs bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="Funcioanlidade" />
        </div>
        @error('functionality')
        <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>
</div>