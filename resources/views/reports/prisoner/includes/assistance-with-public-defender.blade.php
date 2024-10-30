
<div style="padding-bottom: 8px;">
   {{-- Título --}}
   <h1 class="title">ATENDIMENTOS COM DEFENSOR PÚBLICO</h1>
   {{-- Conteúdo --}}
   <section>
      @foreach ($prisoner->assistance_with_public_defenders as $assistance_with_public_defender)

      <div class="line">
         <div class="colum" style="width: 37%;">
            <span class="item_span">Defensor Público: </span>
            <p class="item_p">{{ $assistance_with_public_defender->public_defender->public_defender }}</p>
         </div>

         <div class="colum" style="width: 23%;">
            <span class="item_span">Tipo do Atendimento: </span>
            <p class="item_p">{{ $assistance_with_public_defender->modality_care->modality_care }}</p>
         </div>

         <div class="colum" style="width: 15%;">
            <span class="item_span">Data Atendimento: </span>
            <p class="item_p">{{ \Carbon\Carbon::parse($assistance_with_public_defender->date_of_service)->format('d/m/Y') }}</p>
         </div>

         <div class="colum" style="width: 15%;">
            <span class="item_span">Hora Atendimento: </span>
            <p class="item_p">{{ $assistance_with_public_defender->time_of_service }}</p>
         </div>

         <div class="colum" style="width: 10%;">
            <span class="item_span">Status: </span>
            <p class="item_p">{{ $assistance_with_public_defender->status }}</p>
         </div>
      </div>

      <div class="line" style="padding-bottom: 8px; border-bottom: 1px solid #ccc">
         <span class="item_span">Observações:</span>
         <p class="item_p">{{ $assistance_with_public_defender->remark }}</p>
      </div>
      @endforeach
   </section>
</div>
