
<div style="padding-bottom: 8px;">
   {{-- Título --}}
   <h1 class="title">JUSTIÇA RESTAURATIVA</h1>
   {{-- Conteúdo --}}
   <section>
      @foreach ($prisoner->restorative_justices as $restorative_justice)

      <div class="line">
         <div class="colum" style="width: 37%;">
            <span class="item_span">Conciliador: </span>
            <p class="item_p">{{ $restorative_justice->facilitator_conciliator }}</p>
         </div>

         <div class="colum" style="width: 23%;">
            <span class="item_span">Tipo do Atendimento: </span>
            <p class="item_p">{{ $restorative_justice->modality_care->modality_care }}</p>
         </div>

         <div class="colum" style="width: 15%;">
            <span class="item_span">Data Atendimento: </span>
            <p class="item_p">{{ \Carbon\Carbon::parse($restorative_justice->date_of_service)->format('d/m/Y') }}</p>
         </div>

         <div class="colum" style="width: 15%;">
            <span class="item_span">Hora Atendimento: </span>
            <p class="item_p">{{ $restorative_justice->time_of_service }}</p>
         </div>

         <div class="colum" style="width: 10%;">
            <span class="item_span">Status: </span>
            <p class="item_p">{{ $restorative_justice->status }}</p>
         </div>
      </div>

      <div class="line" style="padding-bottom: 8px; border-bottom: 1px solid #ccc">
         <span class="item_span">Observações:</span>
         <p class="item_p">{{ $restorative_justice->remark }}</p>
      </div>
      @endforeach
   </section>
</div>