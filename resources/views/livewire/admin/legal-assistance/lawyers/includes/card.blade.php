{{-- Conteúdo da Página --}}
<div class="flex justify-center mt-4">

    <div class="flex flex-col items-center pb-10 gap-1 text-xs text-center">
        @if ($lawyer->photo)
            <a title='{{ $lawyer->lawyer }}' href='{{ asset("storage/$lawyer->photo") }}' rel='shadowbox[galeria]'>
                <img class="h-36 w-full rounded-lg" src='{{ asset("storage/$lawyer->photo") }}'
                    alt="{{ $lawyer->lawyer }}">
            </a>
        @else
            <img class="w-24 h-24 bg-zinc-500 rounded-full shadow-lg" src="{{ asset('storage/site/no-image.jpg') }}">
        @endif
        <h5 class="text-sm font-medium text-zinc-900 dark:text-white">{{ $lawyer->lawyer }}</h5>
        <span class="text-xs text-zinc-500 dark:text-zinc-400">
            OAB:{{ $lawyer->register }}
        </span>
        <span class="text-xs text-zinc-500 dark:text-zinc-400">
            Contato:{{ $lawyer->contact }}
        </span>

        {{-- botões --}}
        <div class="flex space-x-8 items-center pb-2">
            <div class="flex">
                <a href="{{ route('lawyers.show', ['lawyer_id' => $lawyer->id]) }}"
                    class="inline-flex items-center px-4 py-1 text-sm font-medium text-center rounded-md text-white bg-blue-700 dark:bg-blue-600
                                hover:bg-blue-800 dark:hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                    Visualizar
                </a>
            </div>
        </div>
    </div>
</div>
