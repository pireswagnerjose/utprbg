<div class="w-full max-w-sm bg-white border border-zinc-200 rounded-lg shadow dark:bg-zinc-800 dark:border-zinc-700">
    <div class="flex flex-col items-center p-8">
        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src='{{ asset("storage/".$identification_card->visitant->photo) }}' alt="Bonnie image"/>
        <h5 class="mb-1 text-xl font-medium text-zinc-900 dark:text-white">{{ $identification_card->visitant->name }}</h5>
        <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ $identification_card->prisoner->name }}</span>
        <div class="flex mt-4 md:mt-6">
            <div class="col-span-1 z-0 w-full group">
                <select wire:model=""
                    class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="">Escolha a Data</option> 
                    <option class="text-zinc-900 dark:text-zinc-600" value="15/11/2024">15/11/2024</option>
                    <option class="text-zinc-900 dark:text-zinc-600" value="16/11/202">16/11/2024</option> 
                </select>
                <x-input-error for="" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>
    </div>
</div>