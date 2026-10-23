{{-- Linha 1 --}}
<div class="grid grid-cols-3 mt-6">
    <div class="relative z-0 w-full group px-6">
        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="text" wire:model.live.debounce.500ms="identificationCardForm.visitant_name" />
            <x-label for="identificationCardForm.date_of_creation" value="{{ 'Nome do Visitante' }}" />
        </div>
    </div>

    <div class="relative z-0 w-full group px-6">
        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="text" wire:model.live.debounce.500ms="identificationCardForm.prisoner_name" />
            <x-label for="identificationCardForm.date_of_creation" value="{{ 'Nome do Preso' }}" />
        </div>
    </div>
    
    <div class="relative z-0 w-full group px-6">
          <select wire:model.live.debounce.500ms="degrees_of_kinship_id"
              class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
              <option class="text-zinc-900 dark:text-zinc-600" selected value="">Grau de Parentesco</option>

              @isset($this->degreeOfKinship)
                  @foreach ($this->degreeOfKinship as $grau_parentesco)
                      <option class="text-zinc-900 dark:text-zinc-600" value="{{ $grau_parentesco->id }}">{{ $grau_parentesco->degree_of_kinship }}</option>
                  @endforeach
              @endisset
          </select>
    </div>
    
</div>
