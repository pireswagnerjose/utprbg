<div class="mb-6">
    <div class="relative z-0 w-full group">
        <div>
            <label for="name" class="block mb-1 text-xs font-light text-zinc-900 dark:text-white">
                Nível de Acesso
            </label>
            <input type="text" id="name" name="name" value="{{ old('nome', $role->name ?? '') }}"
                class="shadow-xs bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="Nível de Acesso" />
        </div>
        @error('name')
        <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>
</div>