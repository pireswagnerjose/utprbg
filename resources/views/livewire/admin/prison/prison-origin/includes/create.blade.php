<div class="container content py-6 mx-auto w-3/4">
    <div class="mx-auto">
        <form wire:submit="create">
            <div class="mb-6">
                <div class="relative z-0 w-full group">
                    <x-input type="text" id="prisonOrigin" wire:model="prisonOrigin" required />
                    <x-label for="prisonOrigin" wire:model="prisonOrigin" value="{{ 'Origem da Prisão' }}" />
                    <x-input-error for="prison_origin" class="mt-2">{{ $message ?? '' }}</x-input-error>
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