<?php

use App\Http\Controllers\PrisonerListController;
use App\Http\Controllers\PrisonerPdfController;
use App\Http\Controllers\Report\ExternalExitReportController;
use App\Http\Controllers\Report\InternalServiceReportController;
use App\Http\Controllers\Report\LegalAssistanceReportController;
use App\Http\Controllers\Report\VisitantReportController;
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
use App\Livewire\Admin\PublicDefender\PublicDefenderLivewire;
use App\Livewire\Admin\Sex\SexLivewire;
use App\Livewire\Admin\SexualOrientation\SexualOrientationLivewire;
use App\Livewire\Admin\State\StateLivewire;
use App\Livewire\Admin\Ward\WardLivewire;
use App\Livewire\Infopen\CertificateOfSentence\CertificateOfSentence;
use App\Livewire\Infopen\CriminalTypes\CriminalTypes;
use App\Livewire\Infopen\Sentence\Sentence;
use App\Livewire\Main\IdentificationCard\IdentificationCardLivewire;
use App\Livewire\Main\IdentificationCard\IdentificationCardShowLivewire;
use App\Livewire\Main\Prisoner\PrisonerLivewire;
use App\Livewire\Main\Prisoner\PrisonerShowLivewire;
use App\Livewire\Main\Visit\VisitCompleted\VisitCompletedLivewire;
use App\Livewire\Main\Visit\VisitControl\VisitControlLivewire;
use App\Livewire\Main\Visit\VisitLivewire;
use App\Livewire\Main\Visit\VisitSchedulingDate\VisitSchedulingDateLivewire;
use App\Livewire\Main\Visitant\VisitantLivewire;
use App\Livewire\Main\Visitant\VisitantShowLivewire;
use App\Livewire\Report\ExternalExit\ExternalExitReportLivewire;
use App\Livewire\Report\InternalService\InternalServiceReport;
use App\Livewire\Report\LegalAssistance\LegalAssistanceReport;
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
    Route::get('/level-accesses', LevelAccessLivewire::class)->name('level-accesses.index')->middleware('can:admin');
    // Users - Usuários
    Route::get('/users-show', UserLivewire::class)->name('users-show.index')->middleware('can:admin');
    // Prison Unit - Unidades Prisionais
    Route::get('/prison-units', PrisonUnitLivewire::class)->name('prison-units.index')->middleware('can:admin');
    // Country - País
    Route::get('/countries', CountryLivewire::class)->name('countries.index')->middleware('can:admin');
    // State - Estado
    Route::get('/states', StateLivewire::class)->name('states.index')->middleware('can:admin');
    // Municipality - Município
    Route::get('/municipalities', MunicipalityLivewire::class)->name('municipalities.index')->middleware('can:admin');
    // Education Levels - Escolaridade
    Route::get('/education-levels', EducationLevelLivewire::class)->name('education-levels.index')->middleware('can:admin');
    // Civil Status - Estado Civil
    Route::get('/civil-statuses', EducationLevelLivewire::class)->name('civil-statuses.index')->middleware('can:admin');
    // ethnicity - Etnia
    Route::get('/ethnicities', EthnicityLivewire::class)->name('ethnicities.index')->middleware('can:admin');
    // Sexual Orientations - Orientação Sexual
    Route::get('/sexual-orientations', SexualOrientationLivewire::class)->name('sexual-orientations.index')->middleware('can:admin');
    // Sex - Sexo
    Route::get('/sexes', SexLivewire::class)->name('sexes.index')->middleware('can:admin');

    // CADASTROS DA UNIDADE
    // Ward - Ala/Pavilhão
    Route::get('/wards', WardLivewire::class)->name('wards.index')->middleware('can:admin');
    // Cell - Cela
    Route::get('/cells', CellLivewire::class)->name('cells.index')->middleware('can:admin');
    
    // PRISON
    // Prison Origins - Origem da Prisão
    Route::get('/prison-origins', PrisonOriginLivewire::class)->name('prison-origins.index')->middleware('can:admin');
    // Type Prisons - Tipo de Prisão
    Route::get('/type-prisons', TypePrisonLivewire::class)->name('type-prisons.index')->middleware('can:admin');
    // Status Prisons - Status da Prisão
    Route::get('/status-prisons', StatusPrisonLivewire::class)->name('status-prisons.index')->middleware('can:admin');
    // Output Types - Status da Prisão
    Route::get('/output-types', OutputTypeLivewire::class)->name('output-types.index')->middleware('can:admin');

    // PROCESS
    // Penal Types - Tipo Penal
    Route::get('/penal-types', PenalTypeLivewire::class)->name('penal-types.index')->middleware('can:admin');
    // Origin Processes - Tipo Penal
    Route::get('/origin-processes', OriginProcessLivewire::class)->name('origin-processes.index')->middleware('can:admin');
    // Process Regimes - Regime do Processo
    Route::get('/process-regimes', ProcessRegimeLivewire::class)->name('process-regimes.index')->middleware('can:admin');
    
    // INTERNAL SERVICE
    // Type Services - Tipos de Atendimento
    Route::get('/type-services', TypeServiceLivewire::class)->name('type-services.index')->middleware('can:admin');

    // EXTERNAL OUTPUT
    // Requestings - Requisitante
    Route::get('/requestings', RequestingLivewire::class)->name('requestings.index')->middleware('can:admin');
    // Exit Reasons - Motivo da Saída
    Route::get('/exit-reasons', ExitReasonLivewire::class)->name('exit-reasons.index')->middleware('can:admin');

    // LEGAL ASSISTANCE
    // lawyers - Advogados
    Route::get('/lawyers', LawyersLivewire::class)->name('lawyers.index')->middleware('can:admin');
    // Public Defender - Defensor Público
    Route::get('/public-defender', PublicDefenderLivewire::class)->name('public-defender.index')->middleware('can:admin');
    // Type Cares - Tipo de Atendimento
    Route::get('/type-cares', TypeCareLivewire::class)->name('type-cares.index')->middleware('can:admin');
    // Modality Care - Modalidade do Atendimento
    Route::get('/modality-cares', ModalityCareLivewire::class)->name('modality-cares.index')->middleware('can:admin');
    // District - Comarcas
    Route::get('/districts', DistrictLivewire::class)->name('districts.index')->middleware('can:admin');
    // Criminal Court - Vara Criminal
    Route::get('/criminal-courts', CriminalCourtLivewire::class)->name('criminal-courts.index')->middleware('can:admin');

    // FAMILIES
    // Degree Of Kinship - Grau de Parentesco
    Route::get('/degrees-of-kinship', DegreeOfKinshipLivewire::class)->name('degrees-of-kinship.index')->middleware('can:admin');

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

    // REPORT
    // Prisoner Report
    Route::any('/prisoner-report/{prisoner_id}', [PrisonerPdfController::class, 'pdf'])->name('prisoner-report');

    // Prisoner List Report
    Route::get('/prisoners-list', PrisonerListReport::class)->name('prisoners-list.index');
    Route::any('/prisoners-list-pdf', [PrisonerListController::class, 'pdf'])->name('prisoner-list.pdf');

    // Internal Service
    Route::get('/internal-service', InternalServiceReport::class)->name('internal-services.index');
    Route::any('/internal-service-pdf', [InternalServiceReportController::class, 'pdf'])->name('internal-services.pdf');
    
    // Legal Assistance
    Route::get('/legal-assistances', LegalAssistanceReport::class)->name('legal-assistances.index');
    Route::any('/legal-assistances-pdf', [LegalAssistanceReportController::class, 'pdf'])->name('legal-assistances.pdf');

    // External Exit
    Route::get('/external-exit', ExternalExitReportLivewire::class)->name('external-exits.index');
    Route::any('/external-exit-pdf', [ExternalExitReportController::class, 'pdf'])->name('external-exits.pdf');
    Route::post('/external-exit-report/{external_exit_id}', [ExternalExitReportController::class, 'report'])->name('external-exit.report');

    // VCAM Report
    Route::get('/vcam-list', VcamReport::class)->name('vcam-list.index')->middleware('can:admin');
    // Route::any('/vcam-list-pdf', [VcamController::class, 'pdf'])->name('vcam-list.pdf');
    Route::any('/vcam-list-pdf', [VcamController::class, 'pdf'])->name('vcam-list.pdf')->middleware('can:admin');

    //INFOPEN
    Route::get('/infopen-certificate-of-sentence', CertificateOfSentence::class)->name('infopen.certificate-of-sentence')->middleware('can:admin');
    Route::get('/infopen-sentence', Sentence::class)->name('infopen.sentence')->middleware('can:admin');
    Route::get('/infopen-criminal-types', CriminalTypes::class)->name('infopen.criminal-types')->middleware('can:admin');

    //Photo - Foto
    // Route::post('/photo-create', [PhotoCreateLivewire::class, 'photoCreate'])->name('photo.create');

    // VISITANT
    Route::get('/visitant', VisitantLivewire::class)->name('visitant.index');
    Route::get('/visitant-show/{visitant_id}', VisitantShowLivewire::class)->name('visitant.show');
    Route::post('/visitant-report/{visitant_id}', [VisitantReportController::class, 'report'])->name('visitant.report');

    // IDENTIFICATION CARD
    Route::get('/identification-card', IdentificationCardLivewire::class)->name('identification-card.index');
    Route::any('/identification-card-show/{identification_card_id}', IdentificationCardShowLivewire::class)->name('identification-card.show');

    // Periodo de Agendamento das visitas
    Route::get('/visit-scheduling-date', VisitSchedulingDateLivewire::class)->name('visit-scheduling-date.index');    
    Route::get('/visit-control', VisitControlLivewire::class)->name('visit-control.index');    
});

// VISIT
Route::get('/visita', VisitLivewire::class)->name('visit.index');
Route::get('/visita-concluida/{visit_completed_id}', VisitCompletedLivewire::class)->name('visit-completed.index');
