{{-- Atendimentos Internos --}}
@if (isset($internal_services) && $internal_services->count() > 0)
<div style="padding-bottom: 8px;">
    {{-- Título --}}
    <h1 class="title">ATENDIMENTOS INTERNOS</h1>
    {{-- Conteúdo --}}
    <section>
        @foreach ($internal_services as $internal_service)
        <div class="line">
            <div class="colum" style="width: 49%;">
                <span class="item_span">Tipo do Atendimento:</span>
                <p class="item_p">{{ $internal_service->type_service->type_service }}</p>
            </div>
            <div class="colum" style="width: 17%;">
                <span class="item_span">Data:</span>
                <p class="item_p">{{ \Carbon\Carbon::parse($internal_service->date)->format('d/m/Y') }}</p>
            </div>
            <div class="colum" style="width: 17%;">
                <span class="item_span">Hora:</span>
                <p class="item_p">{{ $internal_service->time }}</p>
            </div>
            <div class="colum" style="width: 17%;">
                <span class="item_span">Status:</span>
                <p class="item_p">{{ $internal_service->status }}</p>
            </div>
        </div>

        <div class="line" style="padding-bottom: 8px; border-bottom: 1px solid #ccc">
            <span class="item_span">Observações:</span>
            <p class="item_p">{{ $internal_service->remark }}</p>
        </div>
        @endforeach
    </section>
</div>
@endif