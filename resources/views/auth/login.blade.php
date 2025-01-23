<x-guest-layout>
   <div class="min-h-screen p-16 sm:p-0 flex flex-col gap-4 justify-center items-center bg-zinc-100 dark:bg-zinc-900">

      <div class="flex flex-col items-center">
         <a href="/" class="w-24">
            <img src="{{ asset('storage/site/policia_penal_logo.svg') }}" alt="Logo da Polícia Penal">
         </a>
         <h1 class="w-full text-center text-xl m-8">Entre com suas credenciais</h1>
      </div>

      @if (session('status'))
      <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
         {{ session('status') }}
      </div>
      @endif

      <div class="w-full sm:w-[400px]">
         <form method="POST" class="flex flex-col gap-4" action="{{ route('login') }}">
            @csrf
            <div>
               <label class="text-zinc-600 dark:text-zinc-400 text-sm mb-2 block">E-mail</label>
               <div class="relative flex items-center">
                  <input type="email" name="email"
                     class="w-full text-zinc-800 text-sm border border-zinc-300 px-4 py-3 rounded-md outline-blue-600"
                     placeholder="Digite seu e-mail" />
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4"
                     viewBox="0 0 24 24">
                     <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                     <path
                        d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                        data-original="#000000"></path>
                  </svg>
               </div>
               <x-input-error for="email" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>
            <div>
               <label class="text-zinc-600 dark:text-zinc-400 text-sm mb-2 block">Senha</label>
               <div class="relative flex items-center">
                  <input type="password" name="password"
                     class="w-full text-zinc-800 text-sm border border-zinc-300 px-4 py-3 rounded-md outline-blue-600"
                     placeholder="Digite sua senha" />
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                     class="w-4 h-4 absolute right-4 cursor-pointer" viewBox="0 0 128 128">
                     <path
                        d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"
                        data-original="#000000"></path>
                  </svg>
               </div>
               <x-input-error for="password" class="mt-2">{{ $message ?? '' }}</x-input-error>
            </div>

            <div class="block">
               <label for="remember_me" class="flex items-center">
                  <x-checkbox id="remember_me" name="remember" />
                  <span class="ms-2 text-sm text-zinc-600 dark:text-zinc-400">{{ __('Remember me') }}</span>
               </label>
            </div>

            <div class="flex items-center justify-center !mt-8 w-full sm:w-[400px]">
               <button type="submit"
                  class="w-full py-3 px-12 text-base tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                  {{ __('Log in') }}
               </button>
            </div>
         </form>
      </div>
   </div>
</x-guest-layout>