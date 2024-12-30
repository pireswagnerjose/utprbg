{{-- Linha 1 --}}
<div class="grid md:grid-cols-4 gap-4 mt-6 w-[90%] mx-auto">
  <!-- Orientação Sexual -->
  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="sexual_orientation_id"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">ORIENTAÇÃO SEXUAL</option>
      @foreach ($sexual_orientations as $sexual_orientation)
      <option class="text-zinc-900 dark:text-zinc-600" value="{{ $sexual_orientation->id }}">
        {{ $sexual_orientation->sexual_orientation }}
      </option>
      @endforeach
    </select>
  </div>
  <!-- end Orientação Sexual -->

  <!-- Etinia -->
  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="ethnicity_id"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">ETINIA</option>
      @foreach ($ethnicities as $ethnicity)
      <option class="text-zinc-900 dark:text-zinc-600" value="{{ $ethnicity->id }}">
        {{ $ethnicity->ethnicity }}
      </option>
      @endforeach
    </select>
  </div>
  <!-- end Etinia -->

  <!-- Escolaridade -->
  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="education_level_id"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">ESCOLARIDADE</option>
      @foreach ($education_levels as $education_level)
      <option class="text-zinc-900 dark:text-zinc-600" value="{{ $education_level->id }}">
        {{ $education_level->education_level }}
      </option>
      @endforeach
    </select>
  </div>
  <!-- end Escolaridade -->

  <!-- Estado Civil -->
  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="civil_status_id"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">ESTADO CIVIL</option>
      @foreach ($civil_statuses as $civil_status)
      <option class="text-zinc-900 dark:text-zinc-600" value="{{ $civil_status->id }}">
        {{ $civil_status->civil_status }}
      </option>
      @endforeach
    </select>
  </div>
  <!-- end Estado Civil -->
</div>

<div class="grid md:grid-cols-3 gap-4 mt-6 w-[90%] mx-auto">
  <!-- CPF -->
  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="cpf"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">POSSUI CPF</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="sim">SIM</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="nao">NÃO</option>
    </select>
  </div>
  <!-- end CPF -->

  <!-- RG -->
  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="rg"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">POSSUI RG</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="sim">SIM</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="nao">NÃO</option>
    </select>
  </div>
  <!-- end RG -->

  <!-- Título de Eleitor -->
  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="title"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">POSSUI TÍTULO DE ELEITOR</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="sim">SIM</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="nao">NÃO</option>
    </select>
  </div>
  <!-- end Título de Eleitor -->
</div>

<div class="grid md:grid-cols-3 gap-4 mt-6 w-[90%] mx-auto">
  <!-- Certidão de Nascimento -->
  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="birth_certificate"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">POSSUI CERTIDÃO DE NASCIMENTO</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="sim">SIM</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="nao">NÃO</option>
    </select>
  </div>
  <!-- end Certidão de Nascimento -->

  <!-- Reservista -->
  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="reservist"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">POSSUI RESERVISTA</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="sim">SIM</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="nao">NÃO</option>
    </select>
  </div>
  <!-- end Reservista -->

  <!-- Cartão SUS -->
  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="sus_card"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">POSSUI CARTÃO SUS</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="sim">SIM</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="nao">NÃO</option>
    </select>
  </div>
  <!-- end Cartão SUS -->
</div>

<div class="grid md:grid-cols-3 gap-4 mt-6 w-[90%] mx-auto">
  <!-- faixa etária -->
  <div class="col-span-1">
    <p class="text-red-600 uppercase italic">Selecione um valor inicial e final para consultar entre faixa etária.</p>
  </div>
  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="value_start"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">VALOR INICIAL</option>
      @foreach ($values as $start)
      <option class="text-zinc-900 dark:text-zinc-600" value="{{ $start }}">
        {{ $start }} ANOS
      </option>
      @endforeach
    </select>
  </div>

  <div class="col-span-1">
    <select wire:model.live.debounce.500ms="value_end"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">VALOR FINAL</option>
      @foreach ($values as $end)
      <option class="text-zinc-900 dark:text-zinc-600" value="{{ $end }}">
        {{ $end }} ANOS
      </option>
      @endforeach
    </select>
  </div>
  <!-- end faixa etária -->
</div>