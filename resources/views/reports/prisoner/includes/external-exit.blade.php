{{-- Saídas Externas --}}
@if (isset($prisoner->external_exits) && $prisoner->external_exits->count() > 0)
    <div style="padding-bottom: 8px;">
        {{-- Título --}}
        <h1 class="title">SAÍDAS EXTERNAS</h1>
        {{-- Conteúdo --}}
        <section>
            @foreach ($prisoner->external_exits as $external_exit)
                <div class="line">
                    <div class="colum" style="width: 40%;">
                        <span class="item_span">Requisitante:</span>
                        <p class="item_p">{{ $external_exit->requesting->requesting }}</p>
                    </div>
                    <div class="colum" style="width: 40%;">
                        <span class="item_span">Motivo da Saída:</span>
                        <p class="item_p">{{ $external_exit->exit_reason->exit_reason }}</p>
                    </div>
                    <div class="colum" style="width: 20%;">
                        <span class="item_span">Status:</span>
                        <p class="item_p">{{ $external_exit->status }}</p>
                    </div>
                </div>

                <div class="line">
                    <div class="colum" style="width: 17%;">
                        <span class="item_span">Data:</span>
                        <p class="item_p">{{ \Carbon\Carbon::parse($external_exit->event_date)->format('d/m/Y') }}</p>
                    </div>
                    <div class="colum" style="width: 17%;">
                        <span class="item_span">Hora da Saída:</span>
                        <p class="item_p">{{ $external_exit->departure_time }}</p>
                    </div>
                    <div class="colum" style="width: 17%;">
                        <span class="item_span">Hora do Retorno:</span>
                        <p class="item_p">{{ $external_exit->arrival_time }}</p>
                    </div>
                    <div class="colum" style="width: 25%;">
                        <span class="item_span">Município:</span>
                        <p class="item_p" style="text-transform: uppercase;">
                            {{ $external_exit->municipality->municipality }}</p>
                    </div>
                    <div class="colum" style="width: 24%;">
                        <span class="item_span">Estado:</span>
                        <p class="item_p" style="text-transform: uppercase;">{{ $external_exit->state->state }}</p>
                    </div>
                </div>

                <div class="line" style="padding-bottom: 8px; border-bottom: 1px solid #ccc">
                    <span class="item_span">Observações:</span>
                    <p class="item_p">{{ $external_exit->remark }}</p>
                </div>
            @endforeach
        </section>
    </div>
@endif
