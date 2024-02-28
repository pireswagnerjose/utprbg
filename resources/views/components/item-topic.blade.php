@props(['value'])

<label {{ $attributes->merge([
   'class' => 'text-[9pt] uppercase text-zinc-400 dark:text-zinc-500 block'
]) }}>
    {{ $value ?? $slot }}
</label>