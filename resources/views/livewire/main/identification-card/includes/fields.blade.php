<div class="w-full">
    {{-- linha 1 --}}
    <div class="grid md:grid-cols-4 md:gap-8 mb-8 mt-12">
        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="date" wire:model="identificationCardForm.date_of_creation" />
            <x-label for="identificationCardForm.date_of_creation" value="{{ 'Data do Cadastro' }}" />
            <x-input-error for="identificationCardForm.date_of_creation" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>

        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="date" wire:model="identificationCardForm.expiration_date" />
            <x-label for="identificationCardForm.expiration_date" value="{{ 'Data de Validade' }}" />
            <x-input-error for="identificationCardForm.expiration_date" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>

        <div class="col-span-1 relative z-0 w-full group">
            <select wire:model="identificationCardForm.type"
                class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600" selected value="">Tipo</option> 
                <option class="text-zinc-900 dark:text-zinc-600" value="SOCIAL">SOCIAL</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="ÍNTIMA / SOCIAL">ÍNTIMA / SOCIAL</option> 
            </select>
            <x-input-error for="identificationCardForm.type" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>

        <div class="col-span-1 relative z-0 w-full group">
            <select wire:model="identificationCardForm.status"
                class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600" selected value="">Status</option> 
                <option class="text-zinc-900 dark:text-zinc-600" value="ATIVO">ATIVO</option>
                <option class="text-zinc-900 dark:text-zinc-600" value="INATIVO">INATIVO</option> 
            </select>
            <x-input-error for="identificationCardForm.status" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
    </div>

    {{-- Linha 2 --}}
    <div class="grid md:grid-cols-3 mb-8 md:gap-6">
        <div class="relative z-0 w-full group">
            <select wire:model="identificationCardForm.visitant_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $identificationCardForm->visitant->id ?? '' }}">{{
                    $identificationCardForm->visitant->id ?? 'Visitante' }}</option>
                @isset($identificationCardForm->visitants)
                    @foreach ($identificationCardForm->visitants as $visitant)
                        <option class="text-zinc-900 dark:text-zinc-600" value="{{ $visitant->id ?? '' }}"
                            @selected(old('identificationCardForm.visitant_id')==$visitant->id)>{{$visitant->name }}</option>
                    @endforeach
                @endisset
            </select>
            <x-input-error for="identificationCardForm.visitant_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>

        <div class="relative z-0 w-full group">
            <select wire:model="identificationCardForm.prisoner_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $identificationCardForm->prisoner->id ?? '' }}">{{
                    $identificationCardForm->prisoner->id ?? 'Preso' }}</option>
                @isset($identificationCardForm->prisoners)
                    @foreach ($identificationCardForm->prisoners as $prisoner)
                        <option class="text-zinc-900 dark:text-zinc-600" value="{{ $prisoner->id ?? '' }}"
                            @selected(old('identificationCardForm.prisoner_id')==$prisoner->id)>{{$prisoner->name }}</option>
                    @endforeach
                @endisset
            </select>
            <x-input-error for="identificationCardForm.prisoner_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>

        <div class="relative z-0 w-full group">
            <select wire:model="identificationCardForm.degree_of_kinship_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $identificationCardForm->degree_of_kinship->id ?? '' }}">{{
                    $identificationCardForm->degree_of_kinship->id ?? 'Grau de Parentesco' }}</option>
                @isset($identificationCardForm->degree_of_kinships)
                    @foreach ($identificationCardForm->degree_of_kinships as $degree_of_kinship)
                        <option class="text-zinc-900 dark:text-zinc-600" value="{{ $degree_of_kinship->id ?? '' }}"
                            @selected(old('degree_of_kinship_id')==$degree_of_kinship->id)>{{ $degree_of_kinship->degree_of_kinship }}</option>
                    @endforeach
                @endisset
            </select>
            <x-input-error for="identificationCardForm.degree_of_kinship_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
        </div>
    </div>

    {{-- linha 7 --}}
    <div class="relative z-0 w-full group mb-6">
        <textarea wire:model="identificationCardForm.remark" rows="6" class="
                block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md
                bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400
                text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Informações Complementares">
            {{ old('identificationCardForm.remark', $identificationCardForm->visitant->remark ?? '') }}
        </textarea>
    </div>
</div>