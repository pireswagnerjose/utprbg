<?php

use App\Http\Controllers\PrisonerListController;
use App\Http\Controllers\PrisonerPdfController;
use App\Http\Controllers\VcamController;
use App\Livewire\Admin\Cell\CellLivewire;
use App\Livewire\Admin\Country\CountryLivewire;
use App\Livewire\Admin\EducationLevel\EducationLevelLivewire;
use App\Livewire\Admin\Ethnicity\EthnicityLivewire;
use App\Livewire\Admin\ExternalOutput\ExitReason\ExitReasonLivewire;
use App\Livewire\Admin\ExternalOutput\Requesting\RequestingLivewire;
use App\Livewire\Admin\Family\DegreeOfKinship\DegreeOfKinshipLivewire;
use App\Livewire\Admin\InternalService\TypeService\TypeServiceLivewire;
use App\Livewire\Admin\LegalAssistance\CriminalCourt\CriminalCourtLivewire;
use App\Livewire\Admin\LegalAssistance\District\DistrictLivewire;
use App\Livewire\Admin\LegalAssistance\Lawyers\LawyersLivewire;
use App\Livewire\Admin\LegalAssistance\ModalityCare\ModalityCareLivewire;
use App\Livewire\Admin\LegalAssistance\TypeCare\TypeCareLivewire;
use App\Livewire\Admin\LevelAccess\LevelAccessLivewire;
use App\Livewire\Admin\Municipality\MunicipalityLivewire;
use App\Livewire\Admin\Pad\PadEventType\PadEventTypeLivewire;
use App\Livewire\Admin\Pad\PadLocal\PadLocalLivewire;
use App\Livewire\Admin\Pad\PadNatureOfEvent\PadNatureOfEventLivewire;
use App\Livewire\Admin\Pad\PadStatus\PadStatusLivewire;
use App\Livewire\Admin\Pad\PadTypeOfOccurrence\PadTypeOfOccurrenceLivewire;
use App\Livewire\Admin\Prison\OutputType\OutputTypeLivewire;
use App\Livewire\Admin\Prison\PrisonOrigin\PrisonOriginLivewire;
use App\Livewire\Admin\Prison\StatusPrison\StatusPrisonLivewire;
use App\Livewire\Admin\Prison\TypePrison\TypePrisonLivewire;
use App\Livewire\Admin\PrisonUnit\PrisonUnitLivewire;
use App\Livewire\Admin\Process\OriginProcess\OriginProcessLivewire;
use App\Livewire\Admin\Process\PenalType\PenalTypeLivewire;
use App\Livewire\Admin\Process\ProcessRegime\ProcessRegimeLivewire;
use App\Livewire\Admin\Sex\SexLivewire;
use App\Livewire\Admin\SexualOrientation\SexualOrientationLivewire;
use App\Livewire\Admin\State\StateLivewire;
use App\Livewire\Admin\Ward\WardLivewire;
use App\Livewire\Infopen\CertificateOfSentence\CertificateOfSentence;
use App\Livewire\Infopen\CriminalTypes\CriminalTypes;
use App\Livewire\Infopen\Sentence\Sentence;
use App\Livewire\Main\Photo\PhotoCreateLivewire;
use App\Livewire\Main\Prisoner\PrisonerCreateLivewire;
use App\Livewire\Main\Prisoner\PrisonerLivewire;
use App\Livewire\Main\Prisoner\PrisonerShowLivewire;
use App\Livewire\Report\PrisonerList\PrisonerListReport;
use App\Livewire\Report\Vcam\VcamReport;
use App\Livewire\User\UserLivewire;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Level Access - Nível de Acesso
    Route::get('/level-accesses', LevelAccessLivewire::class)->name('level-accesses.index');
    // Users - Usuários
    Route::get('/users-show', UserLivewire::class)->name('users-show.index');
    // Prison Unit - Unidades Prisionais
    Route::get('/prison-units', PrisonUnitLivewire::class)->name('prison-units.index');
    // Country - País
    Route::get('/countries', CountryLivewire::class)->name('countries.index');
    // State - Estado
    Route::get('/states', StateLivewire::class)->name('states.index');
    // Municipality - Município
    Route::get('/municipalities', MunicipalityLivewire::class)->name('municipalities.index');
    // Education Levels - Escolaridade
    Route::get('/education-levels', EducationLevelLivewire::class)->name('education-levels.index');
    // Civil Status - Estado Civil
    Route::get('/civil-statuses', EducationLevelLivewire::class)->name('civil-statuses.index');
    // ethnicity - Etnia
    Route::get('/ethnicities', EthnicityLivewire::class)->name('ethnicities.index');
    // Sexual Orientations - Orientação Sexual
    Route::get('/sexual-orientations', SexualOrientationLivewire::class)->name('sexual-orientations.index');
    // Sex - Sexo
    Route::get('/sexes', SexLivewire::class)->name('sexes.index');

    // CADASTROS DA UNIDADE
    // Ward - Ala/Pavilhão
    Route::get('/wards', WardLivewire::class)->name('wards.index');
    // Cell - Cela
    Route::get('/cells', CellLivewire::class)->name('cells.index');
    
    // PRISON
    // Prison Origins - Origem da Prisão
    Route::get('/prison-origins', PrisonOriginLivewire::class)->name('prison-origins.index');
    // Type Prisons - Tipo de Prisão
    Route::get('/type-prisons', TypePrisonLivewire::class)->name('type-prisons.index');
    // Status Prisons - Status da Prisão
    Route::get('/status-prisons', StatusPrisonLivewire::class)->name('status-prisons.index');
    // Output Types - Status da Prisão
    Route::get('/output-types', OutputTypeLivewire::class)->name('output-types.index');

    // PROCESS
    // Penal Types - Tipo Penal
    Route::get('/penal-types', PenalTypeLivewire::class)->name('penal-types.index');
    // Origin Processes - Tipo Penal
    Route::get('/origin-processes', OriginProcessLivewire::class)->name('origin-processes.index');
    // Process Regimes - Regime do Processo
    Route::get('/process-regimes', ProcessRegimeLivewire::class)->name('process-regimes.index');
    
    // INTERNAL SERVICE
    // Type Services - Tipos de Atendimento
    Route::get('/type-services', TypeServiceLivewire::class)->name('type-services.index');

    // EXTERNAL OUTPUT
    // Requestings - Requisitante
    Route::get('/requestings', RequestingLivewire::class)->name('requestings.index');
    // Exit Reasons - Motivo da Saída
    Route::get('/exit-reasons', ExitReasonLivewire::class)->name('exit-reasons.index');

    // LEGAL ASSISTANCE
    // lawyers - Advogados
    Route::get('/lawyers', LawyersLivewire::class)->name('lawyers.index');
    // Type Cares - Tipo de Atendimento
    Route::get('/type-cares', TypeCareLivewire::class)->name('type-cares.index');
    // Modality Care - Modalidade do Atendimento
    Route::get('/modality-cares', ModalityCareLivewire::class)->name('modality-cares.index');
    // District - Comarcas
    Route::get('/districts', DistrictLivewire::class)->name('districts.index');
    // Criminal Court - Vara Criminal
    Route::get('/criminal-courts', CriminalCourtLivewire::class)->name('criminal-courts.index');

    // FAMILIES
    // Degree Of Kinship - Grau de Parentesco
    Route::get('/degrees-of-kinship', DegreeOfKinshipLivewire::class)->name('degrees-of-kinship.index');

    // PAD
    // Type Of Occurrence - Tipo de Ocorrência
    Route::get('/pad-type-of-occurrences', PadTypeOfOccurrenceLivewire::class)->name('pad-type-of-occurrences.index');
    // Type Of Occurrence - Tipo de Ocorrência
    Route::get('/pad-statuses', PadStatusLivewire::class)->name('pad-statuses.index');
    // Nature Of Events - Natureza da Ocorrência
    Route::get('/pad-nature-of-events', PadNatureOfEventLivewire::class)->name('pad-nature-of-events.index');
    // Locals - Local da Ocorrência
    Route::get('/pad-locals', PadLocalLivewire::class)->name('pad-locals.index');
    // Event Type - Local da Ocorrência
    Route::get('/pad-event-types', PadEventTypeLivewire::class)->name('pad-event-types.index');
    
    // MAIN
    // Prisoner - Preso
    Route::get('/prisoners-search', PrisonerLivewire::class)->name('prisoners.search');
    Route::get('/prisoners/{prisoner_id}', PrisonerShowLivewire::class)->name('prisoners.show');
    Route::get('/prisoners-create', PrisonerCreateLivewire::class)->name('prisoners.create');

    // REPORT
    // Prisoner Report
    Route::any('/prisoner-report/{prisoner_id}', [PrisonerPdfController::class, 'pdf'])->name('prisoner-report');

    // Prisoner List Report
    Route::get('/prisoners-list', PrisonerListReport::class)->name('prisoners-list.index');
    Route::any('/prisoners-list-pdf', [PrisonerListController::class, 'pdf'])->name('prisoner-list.pdf');

    // VCAM Report
    Route::get('/vcam-list', VcamReport::class)->name('vcam-list.index');
    // Route::any('/vcam-list-pdf', [VcamController::class, 'pdf'])->name('vcam-list.pdf');
    Route::any('/vcam-list-csv', [VcamController::class, 'csv'])->name('vcam-list.csv');

    //INFOPEN
    Route::get('/infopen-certificate-of-sentence', CertificateOfSentence::class)->name('infopen.certificate-of-sentence');
    Route::get('/infopen-sentence', Sentence::class)->name('infopen.sentence');
    Route::get('/infopen-criminal-types', CriminalTypes::class)->name('infopen.criminal-types');

    //Photo - Foto
    // Route::post('/photo-create', [PhotoCreateLivewire::class, 'photoCreate'])->name('photo.create');
});
