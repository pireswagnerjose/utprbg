
<div style="padding-bottom: 8px;">
   {{-- Título --}}
   <h1 class="title">ATENDIMENTOS COM ADVOGADO</h1>
   {{-- Conteúdo --}}
   <section>
      @foreach ($prisoner->assistance_with_lawyers as $assistance_with_lawyer)

      <div class="line">
         <div class="colum" style="width: 37%;">
            <span class="item_span">Advogado: </span>
            <p class="item_p">{{ $assistance_with_lawyer->lawyer->lawyer }}</p>
         </div>

         <div class="colum" style="width: 23%;">
            <span class="item_span">Tipo do Atendimento: </span>
            <p class="item_p">{{ $assistance_with_lawyer->modality_care->modality_care }}</p>
         </div>

         <div class="colum" style="width: 15%;">
            <span class="item_span">Data Atendimento: </span>
            <p class="item_p">{{ \Carbon\Carbon::parse($assistance_with_lawyer->date_of_service)->format('d/m/Y') }}</p>
         </div>

         <div class="colum" style="width: 15%;">
            <span class="item_span">Hora Atendimento: </span>
            <p class="item_p">{{ $assistance_with_lawyer->time_of_service }}</p>
         </div>

         <div class="colum" style="width: 10%;">
            <span class="item_span">Status: </span>
            <p class="item_p">{{ $assistance_with_lawyer->status }}</p>
         </div>
      </div>

      <div class="line" style="padding-bottom: 8px; border-bottom: 1px solid #ccc">
         <span class="item_span">Observações:</span>
         <p class="item_p">{{ $assistance_with_lawyer->remark }}</p>
      </div>
      @endforeach
   </section>
</div>
