<div class="flex items-center justify-center w-full h-screen">
   @if ($identification_card)
   @include('livewire.main.visit.includes.card-visit')
   @endif

   @if(!empty($visit_scheduling_start_date))
   @if ($date >= $visit_scheduling_start_date->start_date AND $date <= $visit_scheduling_end_date->end_date)
      <p>
         @if ($visibleForm)
         @include('livewire.main.visit.includes.form-login')
         @endif
      </p>
      @endif
      @else
      <div class="flex flex-col gap-6 px-12">
         <span class=" flex justify-center">
            <img class="w-[25%] sm:w-[20%]" src='{{ asset("storage/site/policia_penal_logo.png") }}'>
         </span>
         <h5 class="text-2xl text-center uppercase font-bold text-red-700 dark:text-red-600">
            Fora do período de marcação de visitas.
         </h5>
         <p class="text-center">FAVOR VOLTAR NOVAMENTE NO PERÍODO CORRETO!</p>
      </div>
      @endif
</div>