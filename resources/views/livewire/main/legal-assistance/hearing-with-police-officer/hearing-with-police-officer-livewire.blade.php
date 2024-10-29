<div>
    <div class="border-b border-blue-400 dark:border-blue-600 flex justify-between">
        <div>
            <button wire:click="modalCreate" type="button" class="mb-4 text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-3 h-3 text-zinc-200 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
            </button>
            <span class="text-sm ml-2 uppercase font-bold text-blue-600">Atendimento com Delegado</span>
        </div>
        <div>
            @if (session('success'))
                <span class="text-green-500 text-sm">{{ session('success') }}</span>
            @endif
            @if (session('danger'))
                <span class="text-red-500 text-sm">{{ session('danger') }}</span>
            @endif
        </div>
    </div>
    
    @forelse ($hearing_with_police_officers as $hearing_with_police_officer)
        @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.card')
    @empty
        <p class="w-full flex mt-4 justify-center text-red-500 text-sm">Não existe agendamento com Delegado cadastrado para esse preso</p>
    @endforelse
    
    {{-- paginação --}}
    <div class="pl-2 py-1 text-zinc-50 dark:text-zinc-400">
        {{ $hearing_with_police_officers->onEachSide(1)->links() }}
    </div>

    @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.modal-create')
    @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.modal-update')
    @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.modal-delete')

    {{-- related documents --}}
    @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.related-document-modal-create')
    @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.related-document-modal-delete')
</div>
