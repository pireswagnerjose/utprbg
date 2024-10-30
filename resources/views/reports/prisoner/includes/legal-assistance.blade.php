{{-- Atendimentos Jurídicos --}}
@if (isset($prisoner->assistance_with_lawyers) && $prisoner->assistance_with_lawyers->count() > 0)
   @include('reports.prisoner.includes.assistance-with-lawyer')
@endif

@if (isset($prisoner->assistance_with_public_defenders) && $prisoner->assistance_with_public_defenders->count() > 0)
   @include('reports.prisoner.includes.assistance-with-public-defender')
@endif

@if (isset($prisoner->restorative_justices) && $prisoner->restorative_justices->count() > 0)
   @include('reports.prisoner.includes.restorative-justice')
@endif

@if (isset($prisoner->hearing_with_police_officers) && $prisoner->hearing_with_police_officers->count() > 0)
   @include('reports.prisoner.includes.hearing-with-police-officer')
@endif

@if (isset($prisoner->videoconference_hearings) && $prisoner->videoconference_hearings->count() > 0)
   @include('reports.prisoner.includes.videoconference-hearing')
@endif