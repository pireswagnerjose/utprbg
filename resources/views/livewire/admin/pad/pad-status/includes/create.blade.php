<div class="container content py-6 mx-auto w-3/4">
    <div class="mx-auto">
        <form wire:submit="padStatusCreate">
            <div class="mb-6">
                <div class="relative z-0 w-full group">
                    <x-input type="text" id="pad_status" wire:model="pad_status" required />
                    <x-label for="pad_status" wire:model="pad_status" value="{{ 'Status da Ocorrência' }}" />
                    <x-input-error for="pad_status" class="mt-2">{{ $message ?? '' }}</x-input-error>
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