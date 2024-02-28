@props(['value'])

<label {{ $attributes->merge([
   'class' => 'text-[11pt] uppercase font-medium text-zinc-800 dark:text-zinc-200 block'
]) }}>
    {{ $value ?? $slot }}
</label>