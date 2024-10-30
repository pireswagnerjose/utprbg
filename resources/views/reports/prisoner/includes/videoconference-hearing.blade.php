
<div style="padding-bottom: 8px;">
   {{-- Título --}}
   <h1 class="title">AUDIÊNCIA POR VIDEOCONFERÊNCIA</h1>
   {{-- Conteúdo --}}
   <section>
      @foreach ($prisoner->videoconference_hearings as $videoconference_hearing)

      <div class="line">
         <div class="colum" style="width: 30%;">
            <span class="item_span">Comarca: </span>
            <p class="item_p">{{ $videoconference_hearing->district->district }}</p>
         </div>

         <div class="colum" style="width: 30%;">
            <span class="item_span">Vara Criminal: </span>
            <p class="item_p">{{ $videoconference_hearing->criminal_court->criminal_court }}</p>
         </div>

         <div class="colum" style="width: 14%;">
            <span class="item_span">Data Atendimento: </span>
            <p class="item_p">{{ \Carbon\Carbon::parse($videoconference_hearing->date_of_service)->format('d/m/Y') }}</p>
         </div>

         <div class="colum" style="width: 14%;">
            <span class="item_span">Hora Atendimento: </span>
            <p class="item_p">{{ $videoconference_hearing->time_of_service }}</p>
         </div>

         <div class="colum" style="width: 12%;">
            <span class="item_span">Status: </span>
            <p class="item_p">{{ $videoconference_hearing->status }}</p>
         </div>
      </div>

      <div class="line" style="padding-bottom: 8px; border-bottom: 1px solid #ccc">
         <span class="item_span">Observações:</span>
         <p class="item_p">{{ $videoconference_hearing->remark }}</p>
      </div>
      @endforeach
   </section>
</div>