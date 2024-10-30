<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
    <div class="mb-12">
        @include('livewire.report.legal-assistance.includes.fields')
    </div>
    <div class="p-8">
        {{-- Formulário --}}
        <form action="{{ route('legal-assistances.pdf') }}" method="any" target="_blank">
            @csrf
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">
            <input type="hidden" name="status" value="{{ $status }}">
            {{-- Gerar PDF --}}
            <div class="flex justify-end mb-6">
                <x-blue-button class="ml-4 bg-green-600">{{ 'Gerar PDF' }} </x-blue-button>
            </div>
        </form>
        @include('livewire.report.legal-assistance.includes.assistance-with-lawyer-table')
        @include('livewire.report.legal-assistance.includes.assistance-with-public-defender-table')
        @include('livewire.report.legal-assistance.includes.hearing-with-police-officer-table')
        @include('livewire.report.legal-assistance.includes.restorative-justice-table')
        @include('livewire.report.legal-assistance.includes.videoconference-hearing-table')
    </div>
</div>

