<?php

use App\Http\Controllers\Acl\AbilityController;
use App\Http\Controllers\Acl\FeatureController;
use App\Http\Controllers\Acl\PermissionController;
use App\Http\Controllers\Acl\RoleController;
use App\Http\Controllers\PrisonerListController;
use App\Http\Controllers\PrisonerPdfController;
use App\Http\Controllers\Report\EducationLevelReportController;
use App\Http\Controllers\Report\ExternalExitReportController;
use App\Http\Controllers\Report\IdentificationCardPdfController;
use App\Http\Controllers\Report\InternalServiceReportController;
use App\Http\Controllers\Report\LawyerPdfController;
use App\Http\Controllers\Report\LegalAssistanceReportController;
use App\Http\Controllers\Report\PrisonerReportController;
use App\Http\Controllers\Report\PrisonReportPdfController;
use App\Http\Controllers\Report\ProcessReportPdfController;
use App\Http\Controllers\Report\ScheduledVisit\ScheduledVisitOfTheDayController;
use App\Http\Controllers\Report\TypePrisonPdfController;
use App\Http\Controllers\Report\VisitantReportController;
use App\Http\Controllers\Report\VisitReportPdfController;
use App\Http\Controllers\VcamController;
use App\Http\Controllers\VisitScheduling\VisitSchedulingController;
use App\Livewire\Admin\Cell\CellLivewire;
use App\Livewire\Admin\CivilStatus\CivilStatusLivewire;
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
use App\Livewire\Admin\LegalAssistance\Lawyers\LawyersShowLivewire;
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
use App\Livewire\Infopen\NumberOfPrisonersWhoHaveRegisteredVisitors\NumberOfPrisonersWhoHaveRegisteredVisitorLivewire;
use App\Livewire\Infopen\NumberPrisonersReceivedVisitsPeriod\NumberPrisonersReceivedVisitsPeriodLivewire;
use App\Livewire\Infopen\Sentence\Sentence;
use App\Livewire\Main\IdentificationCard\IdentificationCardLivewire;
use App\Livewire\Main\IdentificationCard\IdentificationCardShowLivewire;
use App\Livewire\Pages\Prisoner\PrisonerLivewire;
use App\Livewire\Pages\Prisoner\PrisonerShowLivewire;
use App\Livewire\Main\Visit\VisitControl\VisitControlLivewire;
use App\Livewire\Main\Visit\VisitSchedulingDate\VisitSchedulingDateLivewire;
use App\Livewire\Main\Visitant\VisitantLivewire;
use App\Livewire\Main\Visitant\VisitantShowLivewire;
use App\Livewire\Report\EducationLevel\EducationLevelReportLivewire;
use App\Livewire\Report\ExternalExit\ExternalExitReportLivewire;
use App\Livewire\Report\InternalService\InternalServiceReport;
use App\Livewire\Report\LegalAssistance\LegalAssistanceReport;
use App\Livewire\Report\Prison\PrisonReportLivewire;
use App\Livewire\Report\Prisoner\PrisonerReportLivewire;
use App\Livewire\Report\PrisonerList\PrisonerListReport;
use App\Livewire\Report\Process\ProcessReportLivewire;
use App\Livewire\Report\TypePrison\TypePrisonReportLivewire;
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
  Route::get('/civil-statuses', CivilStatusLivewire::class)->name('civil-statuses.index');
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
  Route::get('/lawyers/{lawyer_id}', LawyersShowLivewire::class)->name('lawyers.show');
  Route::any('/lawyer-report/{lawyer_id}', [LawyerPdfController::class, 'pdf'])->name('lawyer.report');

  // Public Defender - Defensor Público
  Route::get('/public-defender', PublicDefenderLivewire::class)->name('public-defender.index');
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
  Route::get('/vcam-list', VcamReport::class)->name('vcam-list.index');
  Route::any('/vcam-list-pdf', [VcamController::class, 'pdf'])->name('vcam-list.pdf');
  Route::any('/vcam-list-csv', [VcamController::class, 'csv'])->name('vcam-list.csv');

  //INFOPEN
  Route::get('/infopen-certificate-of-sentence', CertificateOfSentence::class)->name('infopen.certificate-of-sentence');
  Route::get('/infopen-sentence', Sentence::class)->name('infopen.sentence');
  Route::get('/infopen-criminal-types', CriminalTypes::class)->name('infopen.criminal-types');
  Route::get('/infopen-education-level', EducationLevelReportLivewire::class)->name('infopen-education-level');
  Route::any('/infopen-education-level-pdf', [EducationLevelReportController::class, 'pdf'])->name('infopen-education-level-pdf');
  Route::get('/infopen-prisoner', PrisonerReportLivewire::class)->name('infopen-prisoner');
  Route::any('/infopen-prisoner-pdf', [PrisonerReportController::class, 'pdf'])->name('infopen-prisoner-pdf');
  Route::get('/infopen-prisons', PrisonReportLivewire::class)->name('infopen.prisons');
  Route::post('/infopen-prisons-pdf', [PrisonReportPdfController::class, 'pdf'])->name('infopen.prisons.pdf');
  Route::get('/infopen-type-prisons', TypePrisonReportLivewire::class)->name('infopen.type-prisons');
  Route::any('/infopen-type-prisons-pdf', [TypePrisonPdfController::class, 'pdf'])->name('infopen.type-prisons.pdf');
  Route::any('/infopen-type-prisons-csv', [TypePrisonPdfController::class, 'csv'])->name('infopen.type-prisons.csv');
  Route::get('/infopen-processes', ProcessReportLivewire::class)->name('infopen.processes');
  Route::post('/infopen-processes-pdf', [ProcessReportPdfController::class, 'pdf'])->name('infopen.processes.pdf');
  Route::get('/infopen-number-prisoners-received-visits-period', NumberPrisonersReceivedVisitsPeriodLivewire::class)->name('infopen-number-prisoners-received-visits-period');
  Route::get('/infopen-number-of-prisoners-who-have-registered-visitor', NumberOfPrisonersWhoHaveRegisteredVisitorLivewire::class)->name('infopen-number-of-prisoners-who-have-registered-visitor');

  // VISITANT
  Route::get('/visitant', VisitantLivewire::class)->name('visitant.index');
  Route::post('/visitant-list-pdf', [VisitantReportController::class, 'pdf'])->name('visitant-list.pdf');
  Route::get('/visitant-show/{visitant_id}', VisitantShowLivewire::class)->name('visitant.show');
  Route::post('/visitant-report/{visitant_id}', [VisitantReportController::class, 'report'])->name('visitant.report');

  // IDENTIFICATION CARD
  Route::get('/identification-card', IdentificationCardLivewire::class)->name('identification-card.index');
  Route::any('/identification-card-show/{identification_card_id}', IdentificationCardShowLivewire::class)->name('identification-card.show');
  Route::get('/identification-card-pdf/{identification_card_id}', [IdentificationCardPdfController::class, 'pdf'])->name('identification-card.pdf');

  // Periodo de Agendamento das visitas
  Route::get('/visit-scheduling-date', VisitSchedulingDateLivewire::class)->name('visit-scheduling-date.index');
  Route::get('/visit-control', VisitControlLivewire::class)->name('visit-control.index');

  // Visitas agendadas
  Route::get('/visit-report', [VisitReportPdfController::class, 'index'])->name('visit-report.index');
  Route::get('/visit-pdf', [VisitReportPdfController::class, 'pdf'])->name('visit.pdf');
  Route::delete('/visit/destroy/{id}', [VisitReportPdfController::class, 'destroy'])->name('visit.destroy');

  //Visitas agendadas do dia
  Route::get('/visita-agendada-do-dia', [ScheduledVisitOfTheDayController::class, 'index'])->name('scheduled-visit-of-the-day.index');
  Route::get('/visita-agendada-do-dia-pdf', [ScheduledVisitOfTheDayController::class, 'pdf'])->name('scheduled-visit-of-the-day.pdf');

  // ACL
  /* rotas referente a tablela de Abilidades */
  Route::get('/ability', [AbilityController::class, 'index'])->name('ability.index');
  Route::get('/ability/create', [AbilityController::class, 'create'])->name('ability.create');
  Route::post('/ability/store', [AbilityController::class, 'store'])->name('ability.store');
  Route::get('/ability/edit/{id}', [AbilityController::class, 'edit'])->name('ability.edit');
  Route::put('/ability/update/{id}', [AbilityController::class, 'update'])->name('ability.update');
  Route::delete('/ability/destroy/{id}', [AbilityController::class, 'destroy'])->name('ability.destroy');

  /* rotas referente a tablela de níveis de acesso */
  Route::get('/role', [RoleController::class, 'index'])->name('role.index');
  Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
  Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
  Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
  Route::put('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
  Route::delete('/role/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

  /* rotas referente a tablela de Abilidades */
  Route::get('/feature', [FeatureController::class, 'index'])->name('feature.index');
  Route::get('/feature/create', [FeatureController::class, 'create'])->name('feature.create');
  Route::post('/feature/store', [FeatureController::class, 'store'])->name('feature.store');
  Route::get('/feature/edit/{id}', [FeatureController::class, 'edit'])->name('feature.edit');
  Route::put('/feature/update/{id}', [FeatureController::class, 'update'])->name('feature.update');
  Route::delete('/feature/destroy/{id}', [FeatureController::class, 'destroy'])->name('feature.destroy');

  /* rotas referente a tablela de permissões */
  Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
  Route::get('/permission/create/{ability_id}/{role_id}', [PermissionController::class, 'create'])->name('permission.create');
  Route::delete('/permission/destroy/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
});

// agendamento de visitas
Route::get('/visita', [VisitSchedulingController::class, 'index'])->name('visit-scheduling.index');
Route::post('/visita/create', [VisitSchedulingController::class, 'create'])->name('visit-scheduling.create');
Route::post('/visit/store', [VisitSchedulingController::class, 'store'])->name('visit-scheduling.store');
