<div class="w-full p-4 bg-white rounded-lg shadow sm:p-8 dark:bg-zinc-800">
    <ul class="divide-y divide-zinc-200 dark:divide-zinc-700">
        @forelse ($identification_cards as $identification_card)
            <div class="grid grid-cols-3 gap-6">
                <li class="py-3 sm:py-4 bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 hover:dark:bg-zinc-900 rounded-lg p-4 shadow-md">
                    <a href="{{ route('identification-card.show', ['identification_card_id' => $identification_card->id]) }}">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                @if($identification_card->visitant->photo)
                                    <img class="w-24 h-24 rounded-full" src="{{ asset("storage/" . $identification_card->visitant->photo ) }}" alt="{{$identification_card->visitant->name}}">
                                @endif
                                @if (!$identification_card->visitant->photo)
                                    <img class="w-24 h-24 rounded-full" src="{{ asset("storage/site/no-image.jpg") }}" alt="">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-base font-medium uppercase text-zinc-900 truncate dark:text-white">
                                    {{ $identification_card->visitant->name }}
                                </p>
                                <p class="text-xs uppercase text-zinc-500 truncate dark:text-zinc-400">
                                    {{ $identification_card->prisoner->name }}
                                </p>
                            </div>
                            @empty
                            {{-- exibe mensagem se não encontrar regristro --}}
                            <div class="w-full text-center mb-2 text-xl font-medium tracking-tight text-red-700 dark:text-yellow-300">
                                <h5>
                                    Não foram encontrados registros na sua pesquisa!
                                </h5>
                            </div>
                        </div>
                    </a>
                </li>
            </div>
        @endforelse
    </ul>
</div>