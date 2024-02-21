{{-- Atendimentos Jurídicos --}}
@if (isset($legal_assistances) && $legal_assistances->count() > 0)
<div style="padding-bottom: 8px;">
   {{-- Título --}}
   <h1 class="title">ATENDIMENTOS JURÍDICOS</h1>
   {{-- Conteúdo --}}
   <section>
      @foreach ($legal_assistances as $legal_assistance)

      <div class="line">
         <div class="colum" style="width: 50%;">
            <span class="item_span">Tipo do Atendimento Jurídico: </span>
            <p class="item_p">{{ $legal_assistance->type_care->type_care }}</p>
         </div>
         <div class="colum" style="width: 25%;">
            <span class="item_span">Data: </span>
            <p class="item_p">{{ \Carbon\Carbon::parse($legal_assistance->date)->format('d/m/Y') }}</p>
         </div>
         <div class="colum" style="width: 25%;">
            <span class="item_span">Hora: </span>
            <p class="item_p">{{ $legal_assistance->time }}</p>
         </div>
      </div>

      <div class="line">
         <div class="colum" style="width: 17%;">
            <span class="item_span">Status: </span>
            <p class="item_p">{{ $legal_assistance->status }}</p>
         </div>
         <div class="colum" style="width: 33%;">
            <span class="item_span">Modalidade do Atendimento Jurídico: </span>
            <p class="item_p">{{ $legal_assistance->modality_care->modality_care }}</p>
         </div>
         <div class="colum" style="width: 50%;">
            <span class="item_span">Advogado:</span>
            @if (!empty($legal_assistance->lawyer->lawyer))
            <p class="item_p">{{ $legal_assistance->lawyer->lawyer }}</p>
            @endif
         </div>
      </div>

      <div class="line">
         <div class="colum" style="width: 50%;">
            <span class="item_span">Comarca da Audiência:</span>
            @if (!empty($legal_assistance->district->district))
            <p class="item_p">{{ $legal_assistance->district->district }}</p>
            @endif
         </div>
         <div class="colum" style="width: 50%;">
            <span class="item_span">Vara Criminal:</span>
            @if (!empty($legal_assistance->criminal_court->criminal_court))
            <p class="item_p">{{ $legal_assistance->criminal_court->criminal_court }}</p>
            @endif
         </div>
      </div>

      <div class="line" style="padding-bottom: 8px; border-bottom: 1px solid #ccc">
         <span class="item_span">Observações:</span>
         <p class="item_p">{{ $legal_assistance->remark }}</p>
      </div>
      @endforeach
   </section>
</div>
@endif