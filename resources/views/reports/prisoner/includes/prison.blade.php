{{-- PRISÕES --}}
@if (isset($prisons) && $prisons->count() > 0)
<div style="padding-bottom: 8px;">
    {{-- Título --}}
    <h1 class="title">HISTÓRICO DE PRISÕES</h1>
    {{-- Conteúdo --}}
    <section class="box">
        @foreach ($prisons as $prison)
        <div class="line">
            <div class="colum" style="width: 60%;">
                <span class="item_span">Unidade Prisional:</span>
                <p class="item_p">{{ $prison->prison_unit->prison_unit }}</p>
            </div>
            <div class="colum" style="width: 20%;">
                <span class="item_span">Data da Entrada: </span>
                <p class="item_p">{{ \Carbon\Carbon::parse($prison->entry_date)->format('d/m/Y') }}</p>
            </div>
            <div class="colum" style="width: 20%;">
                <span class="item_span">Data de Saída: </span>
                @empty(!$prison->exit_date)
                <p class="item_p">{{ \Carbon\Carbon::parse($prison->exit_date)->format('d/m/Y') }}</p>
                @endempty
            </div>
        </div>

        <div class="line">
            <div class="colum" style="width: 33%;">
                <span class="item_span">Previsão de Saída: </span>
                @empty(!$prison->exit_forecast)
                <p class="item_p">{{ \Carbon\Carbon::parse($prison->exit_forecast)->format('d/m/Y') }}</p>
                @endempty
            </div>
            <div class="colum" style="width: 33%;">
                <span class="item_span">Data do Último Atestado de Pena: </span>
                @empty(!$prison->sentence_certificate)
                <p class="item_p">{{ \Carbon\Carbon::parse($prison->sentence_certificate)->format('d/m/Y') }}</p>
                @endempty
            </div>
            <div class="colum" style="width: 34%;">
                <span class="item_span">Origem da Prisão: </span>
                <p class="item_p">{{ $prison->prison_origin->prison_origin }}</p>
            </div>
        </div>

        <div class="line">
            <div class="colum" style="width: 40%;">
                <span class="item_span">Tipo da Prisão: </span>
                <p class="item_p">{{ $prison->type_prison->type_prison }}</p>
            </div>
            <div class="colum" style="width: 40%;">
                <span class="item_span">Tipo da Saída: </span>
                <p class="item_p">
                    @isset($prison->output_type->output_type) {{ $prison->output_type->output_type }} @endisset
                </p>
            </div>
            <div class="colum" style="width: 20%;">
                <span class="item_span">Pena (anos, meses e dias):</span>
                <p class="item_p">{{ $prison->sentence }}</p>
            </div>
        </div>

        <div class="line" style="padding-bottom: 8px; border-bottom: 1px solid #ccc">
            <span class="item_span">Observações:</span>
            <p class="item_p">{{ $prison->remarks }}</p>
        </div>
        @endforeach
    </section>
</div>
@endif