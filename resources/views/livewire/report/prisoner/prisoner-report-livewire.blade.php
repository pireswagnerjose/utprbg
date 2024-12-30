<div>
    <div class="mb-12">
        @include('livewire.report.prisoner.includes.fields')
    </div>
    <div class="flex justify-center mb-12">
        <x-blue-button wire:click='clearFieldes' class="ml-4 bg-red-600">{{ 'Limpar Filtros de Pesquisa' }}
        </x-blue-button>
    </div>
    <div class="p-8">
        <!-- Formulário Pdf -->
        <form action="{{ route('infopen-prisoner-pdf') }}" method="any" target="_blank">
            @csrf
            <input type="hidden" name="value_start" value="{{ $value_start }}">
            <input type="hidden" name="value_end" value="{{ $value_end }}">
            <input type="hidden" name="cpf" value="{{ $cpf }}">
            <input type="hidden" name="rg" value="{{ $rg }}">
            <input type="hidden" name="title" value="{{ $title }}">
            <input type="hidden" name="birth_certificate" value="{{ $birth_certificate }}">
            <input type="hidden" name="reservist" value="{{ $reservist }}">
            <input type="hidden" name="sus_card" value="{{ $sus_card }}">
            <input type="hidden" name="sexual_orientation_id" value="{{ $sexual_orientation_id }}">
            <input type="hidden" name="ethnicity_id" value="{{ $ethnicity_id }}">
            <input type="hidden" name="education_level_id" value="{{ $education_level_id }}">
            <input type="hidden" name="civil_status_id" value="{{ $civil_status_id }}">
            {{-- Gerar PDF --}}
            <div class="flex justify-end mb-6">
                <x-blue-button class="ml-4 bg-blue-600">{{ 'Gerar PDF' }} </x-blue-button>
            </div>
        </form>
        <!-- end Formulário Pdf -->

        @include('livewire.report.prisoner.includes.table')
    </div>

    <!-- Paginação -->
    <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
        {{ $prisoners->onEachSide(1)->links() }}
    </div>
    <!-- end Paginação -->
</div>