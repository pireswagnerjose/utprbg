{{-- Familiares --}}
@if (isset($families) && $families->count() > 0)
<div style="padding-bottom: 8px;">
   {{-- Título --}}
   <h1 class="title">FAMILIARES</h1>
   {{-- Conteúdo --}}
   <section>
      @foreach ($families as $family)

      <div class="w-full flex gap-2">
         <div class="colum" style="width: 25%;">
            <span class="item_span">Grau de Parentesco:</span>
            <p class="item_p">{{ $family->degree_of_kinship->degree_of_kinship }}</p>
         </div>
         <div class="colum" style="width: 40%;">
            <span class="item_span">Nome:</span>
            <p class="item_p">{{ $family->name }}</p>
         </div>
         <div class="colum" style="width: 25%;">
            <span class="item_span">Contato:</span>
            <p class="item_p">{{ $family->contact }}</p>
         </div>
         <div class="colum" style="width: 10%;">
            <span class="item_span">Status:</span>
            <p class="item_p">{{ $family->status }}</p>
         </div>
      </div>

      <div class="line" style="padding-bottom: 8px; border-bottom: 1px solid #ccc">
         <span class="item_span">Observações:</span>
         <p class="item_p">{{ $family->remark }}</p>
      </div>
      @endforeach
   </section>
</div>
@endif