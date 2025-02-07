<x-app-layout>
    <div class="container content py-6 mx-auto w-[40%]">
        <div class="mx-auto">
            <form action="{{ $action }}" method="POST">
                @csrf

                <!-- Quando for edição -->
                @isset($feature)
                @method('PUT')
                @endisset

                @include('acl.feature.includes.fields')

                <div class="flex justify-end gap-4">
                    <!-- Btn Blue -->
                    <button type="submit"
                        class="flex items-center gap-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <i data-lucide="plus"
                            class="bg-blue-800/50 rounded-full p-1 w-6 h-6 text-zinc-100 dark:text-zinc-200"></i>
                        @if(isset($feature)) Atualizar @else Cadastrar @endif
                    </button>

                    <!-- Btn Red -->
                    <a href="{{ route('feature.index') }}">
                        <button type="button"
                            class="flex items-center gap-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            <i data-lucide="x"
                                class="bg-red-800/50 rounded-full p-1 w-6 h-6 text-zinc-100 dark:text-zinc-200"></i>
                            <span>Cancelar</span>
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>