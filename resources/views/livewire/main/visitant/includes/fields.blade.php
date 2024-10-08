{{-- linha 1 --}}
<div class="grid grid-cols-6 gap-8 w-full">
    <div class="col-span-1">
        <input type="file" id="photo" class="hidden"
                                wire:model.live="photo"
                                x-ref="photo"
                                x-on:change="
                                        photoName = $refs.photo.files[0].fisrt_name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />
        <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
            {{ 'Selecione a foto do visitante' }}
        </x-secondary-button>
        <x-input-error for="photo" class="mt-2" />

        <div class="w-full flex justify-center">
            @if ($photo)
                <img class="w-48 h-56 mt-6 rounded-md" src="{{ $photo->temporaryUrl() }}" alt="">
            @endif
        </div>
    </div>

    <div class="col-span-5">
        {{-- linha 2 --}}
        <div class="grid md:grid-cols-4 md:gap-8 mb-8 mt-12">
            <div class="col-span-3 relative z-0 w-full group">
                <x-input type="text" wire:model="name" id="name" />
                <x-label for="name" wire:model="name" value="{{ 'Nome' }}" />
                <x-input-error for="name" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-1 relative z-0 w-full group">
                <x-input type="date" wire:model="date_of_birth" id="date_of_birth" />
                <x-label for="date_of_birth" wire:model="date_of_birth" value="{{ 'Data Nasc.' }}" />
                <x-input-error for="date_of_birth" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>

        {{-- Linha 3 --}}
        <div class="grid md:grid-cols-3 mb-8 md:gap-6">
            <div class="col-span-1 relative z-0 w-full group">
                <x-input type="text" wire:model="cpf" id="cpf" x-mask="999.999.999-99" />
                <x-label for="cpf" wire:model="cpf" value="{{ 'CPF' }}" />
                <x-input-error for="cpf" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="relative z-0 w-full group">
                <select id="civil_status_id" wire:model="civil_status_id"
                    class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $civil_status->id ?? '' }}">{{
                        $civil_status->id ?? 'Estado Civil' }}</option>
                    @isset($civil_statuses)
                    @foreach ($civil_statuses as $civil_status)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $civil_status->id ?? '' }}"
                        @selected(old('civil_status_id')==$civil_status->id)>{{$civil_status->civil_status }}</option>
                    @endforeach
                    @endisset
                </select>
                <x-input-error for="civil_status_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="relative z-0 w-full group">
                <select id="sex_id" wire:model="sex_id"
                    class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $sex->id ?? '' }}">{{ $sex->id ?? 'Sexo' }}</option>
                    @isset($sexes)
                    @foreach ($sexes as $sex)
                    <option class="text-zinc-900 dark:text-zinc-600" value="{{ $sex->id ?? '' }}"
                        @selected(old('sex_id')==$sex->id)>{{$sex->sex }}</option>
                    @endforeach
                    @endisset
                </select>
                <x-input-error for="sex_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>

        {{-- Linha 4 --}}
        <div class="grid md:grid-cols-3 mb-8 md:gap-6">
            <div class="col-span-1 relative z-0 w-full group">
                <x-input type="text" wire:model="phone" id="phone" x-mask="(99) 99999-9999" />
                <x-label for="phone" wire:model="phone" value="{{ 'Fone' }}" />
                <x-input-error for="phone" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-1 relative z-0 w-full group">
                <select id="status" wire:model="status"
                    class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="">Status</option> 
                    <option class="text-zinc-900 dark:text-zinc-600" value="ATIVO">ATIVO</option>
                    <option class="text-zinc-900 dark:text-zinc-600" value="INATIVO">INATIVO</option> 
                </select>
                <x-input-error for="status" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-1 relative z-0 w-full group">
                <select id="type_of_residence" wire:model="type_of_residence"
                    class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="">Tipo de Residência</option> 
                    <option class="text-zinc-900 dark:text-zinc-600" value="PRÓPRIA">PRÓPRIA</option>
                    <option class="text-zinc-900 dark:text-zinc-600" value="ALUGADA">ALUGADA</option> 
                    <option class="text-zinc-900 dark:text-zinc-600" value="CEDIDA">CEDIDA</option> 
                </select>
                <x-input-error for="type_of_residence" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>

        {{-- linha 5 --}}
        <div class="grid md:grid-cols-5 mb-8 md:gap-6">
            <div class="col-span-2 relative z-0 w-full group">
                <x-input type="text" wire:model="street" id="street" />
                <x-label for="street" wire:model="street" value="{{ 'Logradouro (Ex. Rua, Av. Alameda, etc.)' }}" />
                <x-input-error for="street" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-1 relative z-0 w-full group">
                <x-input type="text" wire:model="number" id="number" />
                <x-label for="number" wire:model="number" value="{{ 'Número' }}" />
                <x-input-error for="number" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-2 relative z-0 w-full group">
                <x-input type="text" wire:model="complement" id="complement" />
                <x-label for="complement" wire:model="complement" value="{{ 'Complemento' }}" />
                <x-input-error for="complement" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>

        {{-- linha 6 --}}
        <div class="grid md:grid-cols-3 mb-8 md:gap-6">
            <div class="col-span-1 relative z-0 w-full group">
                <x-input type="text" wire:model="barrio" id="barrio" />
                <x-label for="barrio" wire:model="barrio" value="{{ 'Bairro' }}" />
                <x-input-error for="barrio" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
            <div class="col-span-1 relative z-0 w-full group">
                <select id="state_id" wire:model="state_id" wire:change='selectMunicipality' class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $state->id ?? '' }}">{{ $state->id ?? 'Estado' }}</option>
                    @foreach ($states->all(['id']) as $state)
                        <option class="text-zinc-900 dark:text-zinc-600" value="{{ $state->id ?? '' }}" @selected(old('state_id') ==  $state->id)>{{$state->state }}</option>
                    @endforeach
                </select>
                <x-input-error for="state_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
            <div class="col-span-1 relative z-0 w-full group">
                <select id="municipality_id" wire:model="municipality_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $municipalityEdit->id ?? '' }}">{{ $municipalityEdit->municipality ?? 'Cidade' }}</option>
                    @foreach ($municipalities as $municipality)
                        <option class="text-zinc-900 dark:text-zinc-600" value="{{ $municipality->id ?? '' }}" @selected(old('municipality_id') ==  $municipality->id)>{{$municipality->municipality }} - {{$municipality->state->uf }}</option>
                    @endforeach
                </select>
                <x-input-error for="municipality_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>

        {{-- linha 7 --}}
        <div class="relative z-0 w-full group mb-6">
            <textarea id="remark" wire:model="remark" rows="6" class="
                    block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md
                    bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400
                    text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Informações Complementares">
                {{ old('remark', $visitant->remark ?? '') }}
            </textarea>
        </div>

        {{-- botões cadastrar e cancelar --}}
        <div class="flex justify-end">
            <x-danger-button wire:click='cancel'>Cancelar</x-danger-button>
            <x-blue-button class="ml-4">{{ __('Cadastrar') }} </x-blue-button>
        </div>
    </div>
</div>