<div>
    <div class="w-full text-center">
        @if (session('success'))
            <span class="text-green-500 text-sm">{{ session('success') }}</span>
        @endif
        @if (session('danger'))
            <span class="text-red-500 text-sm">{{ session('danger') }}</span>
        @endif
    </div>

    @include('livewire.main.visitant.includes.show-card')
    @include("livewire.main.visitant.includes.modal-update")
    @include("livewire.main.visitant.includes.modal-delete")
</div>
