@props(['disabled' => false])

<input placeholder=" " {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block py-1 px-0 w-full text-base uppercase text-zinc-900 bg-transparent border-0 border-b border-zinc-300 appearance-none dark:text-white dark:border-zinc-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer']) !!}>
