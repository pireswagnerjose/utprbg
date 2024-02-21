<x-report-layout>
    @include('reports.prisoner.includes.prisoner')

    @empty(!$prisonsPDF)
    @include('reports.prisoner.includes.prison')
    @endempty

    @empty(!$processesPDF)
    @include('reports.prisoner.includes.process')
    @endempty

    @empty(!$addressesPDF)
    @include('reports.prisoner.includes.address')
    @endempty

    @empty(!$internal_servicesPDF)
    @include('reports.prisoner.includes.internal-service')
    @endempty

    @empty(!$legal_assistancesPDF)
    @include('reports.prisoner.includes.legal-assistance')
    @endempty

    @empty(!$external_exitsPDF)
    @include('reports.prisoner.includes.external-exit')
    @endempty

    @empty(!$familiesPDF)    
    @include('reports.prisoner.includes.family')
    @endempty

    @empty(!$photosPDF)
    <div style="page-break-after: always;"></div>
    @include('reports.prisoner.includes.photo')
    @endempty
</x-report-layout>