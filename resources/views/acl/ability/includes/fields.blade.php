<div class="mb-6 flex flex-col gap-6">
    <div class="relative z-0 w-full group">
        <div>
            <label for="name" class="block mb-1 text-xs font-light text-zinc-900 dark:text-white">
                Nome do Campo
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $ability->name ?? '') }}"
                class="shadow-xs bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="nome do campo" />
        </div>
        @error('name')
        <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>
    <div class="relative z-0 w-full group">
        <div>
            <label for="nickname" class="block mb-1 text-xs font-light text-zinc-900 dark:text-white">
                Nome da Permissão no Sistema
            </label>
            <input type="text" id="nickname" name="nickname" value="{{ old('nickname', $ability->nickname ?? '') }}"
                class="shadow-xs bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"
                placeholder="Nome da Permissão no Sistema" />
        </div>
        @error('nickname')
        <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>
    <div class="relative z-0 w-full group">
        <div>
            <label for="feature_id" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">
                Funcionalidade</label>
            <select id="feature_id" name="feature_id"
                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option class="text-zinc-900 dark:text-zinc-200" selected value="{{  $ability->feature->id ?? '' }}">
                    {{ $ability->feature->title ?? 'Selecione uma Funcionalidade' }} </option>
                @foreach ($features as $feature)
                <option class="text-zinc-900 dark:text-zinc-200" value="{{ $feature->id }}">{{ $feature->title }}
                </option>
                @endforeach
            </select>
        </div>
        @error('feature_id')
        <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>
</div>