{{-- PRESO --}}
<div>
    {{-- Título --}}
    <h1 class="title">DADOS BÁSICOS DO PRESO</h1>
    {{-- Foto --}}
    <section class="prisoner">
        <article class="prisoner_img">
            @if ($prisoner->photo)
            <div class="">
                <img src='{{ storage_path('app/public/' . $prisoner->photo) }}' alt="{{ "$prisoner->name" }}" class="rounded-lg" >
            </div>
            @else
            <div width="150px" height="200px" style="border-radius: 5px">
                <img src='{{ storage_path('app/public/site/sem_imagem.jpeg') }}' alt="sem imagem" class="rounded-lg">
            </div>
            @endif
        </article>
        {{-- Dados Básicos --}}
        <article class="prisoner_data">
            <div class="line">
                <div class="colum" style="width: 48%;">
                    <span class="item_span">Nome:</span>
                    <p class="item_p" style="font-weight: 700;">{{ $prisoner->name }}</p>
                </div>
                <div class="colum" style="width: 40%;">
                    <span class="item_span">Alcunha:</span>
                    <p class="item_p" style="font-weight: 700;">{{ $prisoner->nickname }}</p>
                </div>
                <div class="colum" style="width: 12%;">
                    <span class="item_span">Data Nasc: </span>
                    <p class="item_p">{{ \Carbon\Carbon::parse($prisoner->date_birth)->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="line">
                <div class="colum" style="width: 25%;">
                    <span class="item_span">CPF: </span>
                    <p class="item_p">{{ $prisoner->cpf }}</p>
                </div>
                <div class="colum" style="width: 25%;">
                    <span class="item_span">RG: </span>
                    <p class="item_p">{{ $prisoner->rg }}</p>
                </div>
                <div class="colum" style="width: 25%;">
                    <span class="item_span">Título Eleitor: </span>
                    <p class="item_p">{{ $prisoner->title }}</p>
                </div>
                <div class="colum" style="width: 25%;">
                    <span class="item_span">Cert. Nasc.: </span>
                    <p class="item_p">{{ $prisoner->birth_certificate }}</p>
                </div>
            </div>

            <div class="line">
                <div class="colum" style="width: 33%;">
                    <span class="item_span">Reservista: </span>
                    <p class="item_p">{{ $prisoner->reservist }}</p>
                </div>
                <div class="colum" style="width: 33%;">
                    <span class="item_span">Cartão SUS: </span>
                    <p class="item_p">{{ $prisoner->sus_card }}</p>
                </div>
                <div class="colum" style="width: 33%;">
                    <span class="item_span">RJI: </span>
                    <p class="item_p">{{ $prisoner->rji }}</p>
                </div>
            </div>

            <div class="line">
                <div class="colum" style="width: 25%">
                    <span class="item_span">Sexo: </span>
                    <p class="item_p">{{ $prisoner->sex->sex }}</p>
                </div>
                <div class="colum" style="width: 25%">
                    <span class="item_span">Etnia: </span>
                    <p class="item_p">{{ $prisoner->ethnicity->ethnicity }}</p>
                </div>
                <div class="colum" style="width: 25%">
                    <span class="item_span">Orientação Sexual: </span>
                    <p class="item_p">{{ $prisoner->sexual_orientation->sexual_orientation }}</p>
                </div>
                <div class="colum" style="width: 25%">
                    <span class="item_span">Estado Civil: </span>
                    <p class="item_p">{{ $prisoner->civil_status->civil_status }}</p>
                </div>
            </div>

            <div class="line">
                <div class="colum" style="width: 50%;">
                    <span class="item_span">Nome da Mãe: </span>
                    <p class="item_p">{{ $prisoner->mother }}</p>
                </div>
                <div class="colum" style="width: 50%;">
                    <span class="item_span">Nome do Pai: </span>
                    <p class="item_p">{{ $prisoner->father }}</p>
                </div>
            </div>


            <div class="line">
                <div class="colum" style="width: 40%;">
                    <span class="item_span">Escolaridade: </span>
                    <p class="item_p">{{ $prisoner->education_level->education_level }}</p>
                </div>
                <div class="colum" style="width: 20%;">
                    <span class="item_span">Status da Prisão:</span>
                    <p class="item_p">{{ $prisoner->status_prison->status_prison }}</p>
                </div>
                <div class="colum" style="width: 40%">
                    <span class="item_span">Prifissão: </span>
                    <p class="item_p">{{ $prisoner->profession }}</p>
                </div>
            </div>

            <div class="line">
                <div class="colum" style="width: 40%; text-transform: uppercase;">
                    <span class="item_span">Naturalidade: </span>
                    <p class="item_p">{{ $prisoner->municipality->municipality }}</p>
                </div>
                <div class="colum" style="width: 40%; text-transform: uppercase;">
                    <span class="item_span">UF: </span>
                    <p class="item_p">{{ $prisoner->state->state }}</p>
                </div>
                <div class="colum" style="width: 20%">
                    <span class="item_span">Nacionalidade: </span>
                    <p class="item_p">{{ $prisoner->country->country }}</p>
                </div>
            </div>
        </article>
    </section>
</div>