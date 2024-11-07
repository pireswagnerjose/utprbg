<div class="w-full h-screen grid place-items-center shadow-lg">
    @if ($identification_card)
        @include('livewire.main.visit.includes.card-visit')
    @endif
    
    @if ($this->date >= $this->start_date AND $this->date <= $this->end_date)
        @if ($visibleForm)
            @include('livewire.main.visit.includes.form-login')
        @endif
    @else
        <div class="block max-w-sm p-6 bg-white border border-zinc-200 rounded-lg shadow hover:bg-zinc-100 dark:bg-zinc-800 dark:border-zinc-700 dark:hover:bg-zinc-700">
            <span class="flex justify-center mb-8">
                <img class="w-1/3" src='{{ asset("storage/site/policia_penal_logo.png") }}' >
            </span>
            <h5 class="mb-2 text-3xl text-center uppercase font-bold tracking-tight text-red-700 dark:text-red-600">
                Fora do período de marcação de visitas
            </h5>
            <p class="text-center italic mt-5">FAVOR VOLTAR NOMENTE NO PERÍODO CORRETO!</p>
        </div>
    @endif
</div>
