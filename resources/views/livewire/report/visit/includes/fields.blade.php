{{-- Linha 1 --}}
<div class="md:flex md:gap-6 mt-6 w-[90%] md:w-[50%] mx-auto">
    <div class="col-span-1 relative z-0 w-full group">
        <select name="type"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">TIPO DA VISITA</option>
            @foreach ($visit_types as $type)
                <option class="text-zinc-900 dark:text-zinc-600" value="{{ $type }}">
                    {{ $type }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-span-1 relative z-0 w-full group">
        <select name="status"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">STATUS DA VISITA</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="MANTIDA">MANTIDA</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="CANCELADA">CANCELADA</option>
        </select>
    </div>
</div>

<div class="md:flex md:gap-6 mt-6 w-[90%] md:w-[50%] mx-auto">
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" name="start_date" />
        <x-label for="start_date" value="{{ 'DATA INICIAL' }}" />
    </div>

    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" name="end_date" />
        <x-label for="end_date" value="{{ 'DATA FINAL' }}" />
    </div>
</div>
