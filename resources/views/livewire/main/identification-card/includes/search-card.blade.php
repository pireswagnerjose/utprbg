<div class="w-full p-4 bg-white rounded-lg shadow dark:bg-zinc-800">
    <ul class="">
        <div class="grid grid-cols-3 gap-6">
            @forelse ($identification_cards as $identification_card)
                <li class="py-2">
                    <div class="flex flex-col items-center pb-10 gap-1 text-xs text-center">
                        @if($identification_card->visitant->photo)
                            <img class="w-24 h-24 bg-zinc-500 rounded-full shadow-lg" src='{{ asset( "storage/".$identification_card->visitant->photo ) }}' alt="{{ $identification_card->visitant->name }}"/>
                        @endif
                        @if (!$identification_card->visitant->photo)
                            <img class="w-24 h-24 bg-zinc-500 rounded-full shadow-lg" src="{{ asset("storage/site/no-image.jpg") }}" alt="Sem Imagem">
                        @endif
                        <h5 class="text-sm font-medium text-zinc-900 dark:text-white">Visitante: {{ $identification_card->visitant->name }}</h5>
                        <h5 class="text-xs font-medium text-zinc-900 dark:text-white">Preso: {{ $identification_card->prisoner->name }}</h5>
                        <div class="flex">
                            <a href="{{ route('identification-card.show', ['identification_card_id' => $identification_card->id]) }}" class="inline-flex items-center px-4 py-1 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Visualizar</a>
                        </div>
                    </div>
                </li>
            @empty
                {{-- exibe mensagem se não encontrar regristro --}}
                <div class="w-full text-center mb-2 text-xl font-medium tracking-tight text-red-700 dark:text-yellow-300">
                    <h5>
                        Não foram encontrados registros na sua pesquisa!
                    </h5>
                </div>
            @endforelse
        </div>
    </ul>
</div>