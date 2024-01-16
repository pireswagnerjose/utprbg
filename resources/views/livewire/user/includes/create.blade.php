<div class="container content py-6 mx-auto">
    <div class="mx-auto">
        <form wire:submit="create">
            {{-- campos do formulário --}}
            @include('livewire.user.includes.field')
            
            @if (session('success'))
                <span class="text-green-500 text-sm">{{ session('success') }}</span>
            @endif

        </form>

    </div>
</div>