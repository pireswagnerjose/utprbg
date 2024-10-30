
<div style="padding-bottom: 8px;">
   {{-- Título --}}
   <h1 class="title">OITIVA COM DELEGADO</h1>
   {{-- Conteúdo --}}
   <section>
      @foreach ($prisoner->hearing_with_police_officers as $hearing_with_police_officer)

      <div class="line">
         <div class="colum" style="width: 30%;">
            <span class="item_span">Delegado: </span>
            <p class="item_p">{{ $hearing_with_police_officer->delegate }}</p>
         </div>

         <div class="colum" style="width: 16%;">
            <span class="item_span">Delegacia: </span>
            <p class="item_p">{{ $hearing_with_police_officer->police_station }}</p>
         </div>

         <div class="colum" style="width: 18%;">
            <span class="item_span">Tipo do Atendimento: </span>
            <p class="item_p">{{ $hearing_with_police_officer->modality_care->modality_care }}</p>
         </div>

         <div class="colum" style="width: 13%;">
            <span class="item_span">Data Atendimento: </span>
            <p class="item_p">{{ \Carbon\Carbon::parse($hearing_with_police_officer->date_of_service)->format('d/m/Y') }}</p>
         </div>

         <div class="colum" style="width: 13%;">
            <span class="item_span">Hora Atendimento: </span>
            <p class="item_p">{{ $hearing_with_police_officer->time_of_service }}</p>
         </div>

         <div class="colum" style="width: 10%;">
            <span class="item_span">Status: </span>
            <p class="item_p">{{ $hearing_with_police_officer->status }}</p>
         </div>
      </div>

      <div class="line" style="padding-bottom: 8px; border-bottom: 1px solid #ccc">
         <span class="item_span">Observações:</span>
         <p class="item_p">{{ $hearing_with_police_officer->remark }}</p>
      </div>
      @endforeach
   </section>
</div>