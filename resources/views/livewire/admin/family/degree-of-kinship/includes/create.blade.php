<div class="container content py-6 mx-auto w-3/4">
    <div class="mx-auto">
        <form wire:submit="degreeOfKinshipCreate">
            <div class="mb-6">
                <div class="relative z-0 w-full group">
                    <x-input type="text" id="degree_of_kinship" wire:model="degree_of_kinship" required />
                    <x-label for="degree_of_kinship" wire:model="degree_of_kinship" value="{{ 'Grau de Parentesco' }}" />
                    <x-input-error for="degree_of_kinship" class="mt-2">{{ $message ?? '' }}</x-input-error>
                </div>
            </div>
            <div class="flex justify-end">
                <x-button> {{ 'Adicionar' }} </x-button>
                <x-danger-button class="ms-3" wire:click.prevent="cancel">{{ 'Cancelar' }}</x-danger-button>
            </div>
            @if (session('success'))
                <span class="text-green-500 text-sm">{{ session('success') }}</span>
            @endif
        </form>
    </div>
</div>