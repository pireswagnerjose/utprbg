<div class="w-full sm:w-[35%]">
    <form>
        <div class="flex flex-col items-center">
            <img class="w-36 h-36 mb-3 rounded-full shadow-lg"
                src='{{ asset("storage/".$identification_card->visitant->photo) }}' alt="Bonnie image" width="144px"
                height="144px" />
            <h5 class="mb-1 text-xl font-medium text-zinc-900 dark:text-white">{{ $identification_card->visitant->name
                }}</h5>
            <span class="text-sm text-zinc-500 dark:text-zinc-400 text-center mt-4">Reeducando:<br> {{
                $identification_card->prisoner->name }}</span>

            <div class="mt-4 md:mt-6">
                <div class="col-span-1 z-0 w-full group mt-6">
                    <select wire:model="date_visit"
                        class="uppercase block p-1 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                        <option class="bg-zinc-100 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 text-xs" selected
                            value="">Escolha a Data da Visita
                        </option>
                        @if (!empty($visit_date1))
                        <option class="bg-zinc-100 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 text-base"
                            value="{{ $visit_date1->date }}">{{
                            \Carbon\Carbon::parse($visit_date1->date)->format('d/m/Y') }}
                        </option>
                        @endif
                        @if (!empty($visit_date2))
                        <option class="bg-zinc-100 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 text-base"
                            value="{{ $visit_date2->date }}">{{
                            \Carbon\Carbon::parse($visit_date2->date)->format('d/m/Y') }}
                        </option>
                        @endif
                    </select>
                    <x-input-error for="date_visit" class="mt-2">{{ $message ?? '' }}</x-input-error>
                </div>
            </div>
        </div>
        <div class="grid place-items-center pt-4 mb-6">
            <button type="button" wire:click="schedule_visit"
                class="w-1/2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Agendar
            </button>
        </div>
    </form>
</div>