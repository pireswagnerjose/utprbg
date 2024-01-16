@props(['disabled' => false])

{{-- <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}> --}}
<input placeholder=" " {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block py-1 px-0 w-full text-base text-zinc-900 bg-transparent border-0 border-b border-zinc-300 appearance-none dark:text-white dark:border-zinc-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer']) !!}>
