<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
    <div class="mb-12">
        @include('livewire.report.internal-service.includes.fields')
    </div>
    <div class="p-8">
        {{-- Formulário --}}
        <form action="{{ route('internal-services.pdf') }}" method="any" target="_blank">
            @csrf
            <input type="hidden" name="type_service_id" value="{{ $type_service_id }}">
            <input type="hidden" name="start_date" value="{{ $start_date }}">
            <input type="hidden" name="end_date" value="{{ $end_date }}">
            <input type="hidden" name="status" value="{{ $status }}">
            {{-- Gerar PDF --}}
            <div class="flex justify-end mb-6">
                <x-blue-button class="ml-4 bg-green-600">{{ 'Gerar PDF' }} </x-blue-button>
            </div>
        </form>

        @include('livewire.report.internal-service.includes.table')
    </div>
    
    {{-- paginação --}}
    <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
        {{ $internal_services->onEachSide(1)->links() }}
    </div>
</div>
