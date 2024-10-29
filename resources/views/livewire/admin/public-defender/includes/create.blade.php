<div class="container content py-6 mx-auto w-3/4">
    <div class="mx-auto">
        <form wire:submit="store">
            <div class="grid grid-cols-3 gap-8">
                <div class="mb-6 col-span-2">
                    <div class="relative z-0 w-full group">
                        <x-input type="text" id="public_defender" wire:model="public_defender" />
                        <x-label for="public_defender" value="Defensor Público" />
                        <x-input-error for="public_defender" class="mt-2">{{ $message ?? '' }}</x-input-error>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="relative z-0 w-full group">
                        <x-input type="text" id="contact" wire:model="contact" x-mask="(99) 99999-9999" />
                        <x-label for="contact" value="Contato" />
                        <x-input-error for="contact" class="mt-2">{{ $message ?? '' }}</x-input-error>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end">
                <x-button> {{ 'Adicionar' }} </x-button>
                <x-danger-button class="ms-3" wire:click.prevent="cancel">{{ 'Cancelar' }}</x-danger-button>
            </div>
        </form>
    </div>
</div>