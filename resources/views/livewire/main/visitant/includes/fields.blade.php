{{-- linha 1 --}}
<div class="grid grid-cols-6 gap-8 w-full">
    <div class="col-span-1">
        <input type="file" id="photo" class="hidden"
                                wire:model.live="visitantForm.photo"
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
        <x-input-error for="visitantForm.photo" class="mt-2" />

        <div class="w-full flex justify-center">
            @if ($this->visitantForm->photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                <img src="{{ $this->visitantForm->photo->temporaryUrl() }}"
                    alt="Profile photo preview" class="w-48 h-56 mt-6 rounded-md object-cover"/>
            @elseif (!empty($visitant->photo))
                <img src="{{ $visitant->photo ? asset("storage/$visitant->photo") : asset('storage/site/no-image.jpg') }}"
                    alt="Profile photo" class="w-48 h-56 mt-6 rounded-md object-cover"/>
            @else
                <img src="{{ asset('storage/site/no-image.jpg') }}"
                        alt="Profile photo" class="w-48 h-56 mt-6 rounded-md object-cover"/>
            @endif
        </div>
    </div>

    <div class="col-span-5">
        {{-- linha 2 --}}
        <div class="grid md:grid-cols-4 md:gap-8 mb-8 mt-12">
            <div class="col-span-3 relative z-0 w-full group">
                <x-input type="text" wire:model="visitantForm.name" />
                <x-label for="visitantForm.name" value="{{ 'Nome' }}" />
                <x-input-error for="visitantForm.name" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-1 relative z-0 w-full group">
                <x-input type="date" wire:model="visitantForm.date_of_birth" />
                <x-label for="visitantForm.date_of_birth" value="{{ 'Data Nasc.' }}" />
                <x-input-error for="visitantForm.date_of_birth" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>

        {{-- Linha 3 --}}
        <div class="grid md:grid-cols-3 mb-8 md:gap-6">
            <div class="col-span-1 relative z-0 w-full group">
                <x-input type="text" wire:model="visitantForm.cpf" x-mask="999.999.999-99" />
                <x-label for="visitantForm.cpf" value="{{ 'CPF' }}" />
                <x-input-error for="visitantForm.cpf" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="relative z-0 w-full group">
                <select wire:model="visitantForm.civil_status_id"
                    class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $this->visitantForm->civil_status->id ?? '' }}">{{
                        $this->visitantForm->civil_status->id ?? 'Estado Civil' }}</option>
                    @isset($this->visitantForm->civil_statuses)
                        @foreach ($visitantForm->civil_statuses as $civil_status)
                            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $civil_status->id ?? '' }}"
                                @selected(old('visitantForm.civil_status_id')==$civil_status->id)>{{$civil_status->civil_status }}</option>
                        @endforeach
                    @endisset
                </select>
                <x-input-error for="visitantForm.civil_status_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="relative z-0 w-full group">
                <select wire:model="visitantForm.sex_id"
                    class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $this->visitantForm->sex->id ?? '' }}">{{ $this->visitantForm->sex->id ?? 'Sexo' }}</option>
                    @isset($this->visitantForm->sexes)
                        @foreach ($this->visitantForm->sexes as $sex)
                            <option class="text-zinc-900 dark:text-zinc-600" value="{{ $sex->id ?? '' }}"
                                @selected(old('visitantForm.sex_id')==$sex->id)>{{$sex->sex }}</option>
                        @endforeach
                    @endisset
                </select>
                <x-input-error for="visitantForm.sex_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>

        {{-- Linha 4 --}}
        <div class="grid md:grid-cols-3 mb-8 md:gap-6">
            <div class="col-span-1 relative z-0 w-full group">
                <x-input type="text" wire:model="visitantForm.phone" x-mask="(99) 99999-9999" />
                <x-label for="visitantForm.phone" value="{{ 'Fone' }}" />
                <x-input-error for="visitantForm.phone" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-1 relative z-0 w-full group">
                <select wire:model="visitantForm.status"
                    class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="">Status</option> 
                    <option class="text-zinc-900 dark:text-zinc-600" value="ATIVO">ATIVO</option>
                    <option class="text-zinc-900 dark:text-zinc-600" value="INATIVO">INATIVO</option> 
                </select>
                <x-input-error for="visitantForm.status" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-1 relative z-0 w-full group">
                <select wire:model="visitantForm.type_of_residence"
                    class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="">Tipo de Residência</option> 
                    <option class="text-zinc-900 dark:text-zinc-600" value="PRÓPRIA">PRÓPRIA</option>
                    <option class="text-zinc-900 dark:text-zinc-600" value="ALUGADA">ALUGADA</option> 
                    <option class="text-zinc-900 dark:text-zinc-600" value="CEDIDA">CEDIDA</option> 
                </select>
                <x-input-error for="visitantForm.type_of_residence" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>

        {{-- linha 5 --}}
        <div class="grid md:grid-cols-5 mb-8 md:gap-6">
            <div class="col-span-2 relative z-0 w-full group">
                <x-input type="text" wire:model="visitantForm.street" />
                <x-label for="visitantForm.street" value="{{ 'Logradouro (Ex. Rua, Av. Alameda, etc.)' }}" />
                <x-input-error for="visitantForm.street" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-1 relative z-0 w-full group">
                <x-input type="text" wire:model="visitantForm.number" />
                <x-label for="visitantForm.number" value="{{ 'Número' }}" />
                <x-input-error for="visitantForm.number" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="col-span-2 relative z-0 w-full group">
                <x-input type="text" wire:model="visitantForm.complement" />
                <x-label for="visitantForm.complement" value="{{ 'Complemento' }}" />
                <x-input-error for="visitantForm.complement" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>

        {{-- linha 6 --}}
        <div class="grid md:grid-cols-3 mb-8 md:gap-6">
            <div class="col-span-1 relative z-0 w-full group">
                <x-input type="text" wire:model="visitantForm.barrio" />
                <x-label for="visitantForm.barrio" value="{{ 'Bairro' }}" />
                <x-input-error for="visitantForm.barrio" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
            <div class="col-span-1 relative z-0 w-full group">
                <select wire:model="visitantForm.state_id" wire:change='selectMunicipality' class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $this->visitantForm->state->id ?? '' }}">{{ $this->visitantForm->state->id ?? 'Estado' }}</option>
                    @foreach ($this->visitantForm->states as $state)
                        <option class="text-zinc-900 dark:text-zinc-600" value="{{ $state->id ?? '' }}" @selected(old('visitantForm.state_id') ==  $state->id)>{{$state->state }}</option>
                    @endforeach
                </select>
                <x-input-error for="visitantForm.state_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
            <div class="col-span-1 relative z-0 w-full group">
                <select wire:model="visitantForm.municipality_id" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
                    <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $this->visitantForm->municipalityEdit->id ?? '' }}">{{ $this->visitantForm->municipalityEdit->municipality ?? 'Cidade' }}</option>
                    @foreach ($this->visitantForm->municipalities as $municipality)
                        <option class="text-zinc-900 dark:text-zinc-600" value="{{ $municipality->id ?? '' }}" @selected(old('visitantForm.municipality_id') ==  $municipality->id)>{{$municipality->municipality }} - {{$municipality->state->uf }}</option>
                    @endforeach
                </select>
                <x-input-error for="visitantForm.municipality_id" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
        </div>

        {{-- linha 7 --}}
        <div class="relative z-0 w-full group">
            <textarea wire:model="visitantForm.remark" rows="6" class="
                    block p-2.5 w-full uppercase text-sm rounded-lg border focus:ring-blue-500 focus:border-blue-500 shadow-md
                    bg-zinc-100 dark:bg-zinc-700 border-zinc-300 dark:border-zinc-600 placeholder-zinc-600 dark:placeholder-zinc-400
                    text-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Informações Complementares">
                {{ old('visitantForm.remark', $this->visitantForm->remark ?? '') }}
            </textarea>
        </div>
    </div>
</div>