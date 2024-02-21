{{-- Endereços --}}
@if (isset($addresses) && $addresses->count() > 0)
<div style="padding-bottom: 8px;">
    {{-- Título --}}
    <h1 class="title">ENDEREÇOS CONHECIDOS</h1>
    {{-- Conteúdo --}}
    <section>
        @foreach ($addresses as $address)
        <div class="line">
            <div class="colum" style="width: 50%;">
                <span class="item_span">Logradouro:</span>
                <p class="item_p">{{ $address->street }}</p>
            </div>
            <div class="colum" style="width: 17%;">
                <span class="item_span">Número:</span>
                <p class="item_p">{{ $address->number }}</p>
            </div>
            <div class="w-colum" style="width: 33%;">
                <span class="item_span">Complemento:</span>
                <p class="item_p">{{ $address->complement }}</p>
            </div>
        </div>

        <div class="line">
            <div class="colum" style="width: 50%;">
                <span class="item_span">Bairro:</span>
                <p class="item_p">{{ $address->barrio }}</p>
            </div>
            <div class="colum" style="width: 33%;">
                <span class="item_span">Cidade: </span>
                <p class="item_p" style="text-transform: uppercase;">{{ $address->municipality->municipality }}</p>
            </div>
            <div class="colum" style="width: 17%;">
                <span class="item_span">Estado:</span>
                <p class="item_p" style="text-transform: uppercase;">{{ $address->state->state }}</p>
            </div>
        </div>

        <div class="line" style="padding-bottom: 8px; border-bottom: 1px solid #ccc">
            <span class="item_span">Observações:</span>
            <p class="item_p">{{ $address->remark }}</p>
        </div>
        @endforeach
    </section>
</div>
@endif