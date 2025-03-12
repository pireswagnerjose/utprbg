{{-- linha 1 --}}
<div class="grid md:grid-cols-3 md:gap-6 mt-16 mb-6">
    <div class="relative z-0 w-full group mt-2">
        <select wire:model.live.debounce.500ms="list_type" required
            class="block py-0.5 px-2 w-full text-sm uppercase text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-800 dark:text-zinc-100 bg-zinc-100 dark:bg-zinc-800" selected value="">
                <span>Selecione o tipo de lista</span>
            </option>

            <option class="text-zinc-800 dark:text-zinc-100 bg-zinc-100 dark:bg-zinc-800" value="list">
                <span>Listagem geral</span>
            </option>

            <option class="text-zinc-800 dark:text-zinc-100 bg-zinc-100 dark:bg-zinc-800" value="conference">
                <span>Listagem por cela</span>
            </option>
        </select>
    </div>

    {{-- Ala - Pavilhão --}}
    <div class="relative z-0 w-full group mt-2">
        <select wire:model.live.debounce.500ms="ward_id"
            class="block py-0.5 px-2 w-full text-sm uppercase text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-800 dark:text-zinc-100 bg-zinc-100 dark:bg-zinc-800" selected value="">
                <span>Ala - Pavilhão</span>
            </option>
            @foreach ($wards as $ward)
                <option class="text-zinc-800 dark:text-zinc-100 bg-zinc-100 dark:bg-zinc-800"
                    value="{{ $ward->id }}">
                    {{ $ward->ward }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Com ou sem foto --}}
    <div class="relative z-0 w-full group mt-2">
        <select wire:model.live.debounce.500ms="c_s_photo" required
            class="block py-0.5 px-2 w-full text-sm uppercase text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-800 dark:text-zinc-100 bg-zinc-100 dark:bg-zinc-800" selected value="">
                <span>Com ou Sem Foto</span>
            </option>
            <option class="text-zinc-800 dark:text-zinc-100 bg-zinc-100 dark:bg-zinc-800" value="1">
                Com Foto
            </option>
            <option class="text-zinc-800 dark:text-zinc-100 bg-zinc-100 dark:bg-zinc-800" value="2">
                Sem Foto
            </option>
        </select>
    </div>
</div>
