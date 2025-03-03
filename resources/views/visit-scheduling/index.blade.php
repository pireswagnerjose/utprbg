<x-guest-layout>

    @if ($visit_scheduling_start_date != null and $visit_scheduling_end_date != null)
        <div class="flex flex-col gap-6 px-12 items-center justify-center min-h-screen">
            @php
                $start_date = $visit_scheduling_start_date->start_date;
                $end_date = $visit_scheduling_end_date->end_date;
            @endphp
            @if ($current_date >= $start_date and $current_date <= $end_date)
                @include('visit-scheduling.includes.form-login')
            @else
                <div class="flex flex-col gap-6 px-12 items-center justify-center min-h-screen">
                    <span class=" flex justify-center">
                        <img class="w-[25%] sm:w-[20%]" src='{{ asset('storage/site/policia_penal_logo.png') }}'>
                    </span>
                    <h5 class="text-2xl text-center uppercase font-bold text-red-700 dark:text-red-600">
                        Fora do período de marcação de visitas.
                    </h5>
                    <p class="text-center">FAVOR VOLTAR NOVAMENTE NO PERÍODO CORRETO!</p>
                </div>
            @endif
        </div>
    @else
        <div class="flex flex-col gap-6 px-12 items-center justify-center min-h-screen">
            <span class=" flex justify-center">
                <img class="w-[25%] sm:w-[20%]" src='{{ asset('storage/site/policia_penal_logo.png') }}'>
            </span>
            <h5 class="text-2xl text-center uppercase font-bold text-red-700 dark:text-red-600">
                Fora do período de marcação de visitas.
            </h5>
            <p class="text-center">FAVOR VOLTAR NOVAMENTE NO PERÍODO CORRETO!</p>
        </div>
    @endif

</x-guest-layout>
