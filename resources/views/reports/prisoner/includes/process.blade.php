{{-- PROCESSOS --}}
@if (isset($prisoner->processes) && $prisoner->processes->count() > 0)
<div class="pb-2">
    {{-- Título --}}
    <h1 class="title">PROCESSOS</h1>
    {{-- Conteúdo --}}
    <section>
        @foreach ($prisoner->processes as $process)
        <div class="line">
            <div class="colum" style="width: 25%;">
                <span class="item_span">Data da Prisão no Processo: </span>
                <p class="item_p">{{ \Carbon\Carbon::parse($process->date_arrest)->format('d/m/Y') }}</p>
            </div>
            <div class="colum" style="width: 25%;">
                <span class="item_span">Data de Alvará no Processo: </span>
                @empty(!$process->date_exit)
                <p class="item_p">{{ \Carbon\Carbon::parse($process->date_exit)->format('d/m/Y') }}</p>
                @endempty
            </div>
            <div class="colum" style="width: 50%;">
                <span class="item_span">Regime da Prisão: </span>
                <p class="item_p">{{ $process->process_regime->process_regime }}</p>
            </div>
        </div>

        <div class="line">
            <div class="colum" style="width: 34%;">
                <span class="item_span">Origem do Processo: </span>
                <p class="item_p">{{ $process->origin_process->origin_process }}</p>
            </div>
            <div class="colum" style="width: 33%;">
                <span class="item_span">Comarca de Origem: </span>
                <p class="item_p">{{ $process->judicial_district_origin }}</p>
            </div>
            <div class="colum" style="width: 33%;">
                <span class="item_span">Número do EPROC: </span>
                <p class="item_p">{{ $process->eproc }}</p>
            </div>
        </div>

        <div class="line">
            <div class="colum" style="width: 34%;">
                <span class="item_span">Número do SEEU: </span>
                <p class="item_p">{{ $process->seeu }}</p>
            </div>
            <div class="colum" style="width: 33%;">
                <span class="item_span">Número do PJE: </span>
                <p class="item_p">{{ $process->pje }}</p>
            </div>
            <div class="colum" style="width: 33%;">
                <span class="item_span">Número do APF: </span>
                <p class="item_p">{{ $process->apf }}</p>
            </div>
        </div>

        <div class="line">
            <span class="item_span">Observações:</span>
            <p class="item_p">{{ $process->remark }}</p>
        </div>
        @endforeach
    </section>
</div>
@endif