<div>
    <x-item-topic> Visitas Agendadas do Visitante </x-item-topic>

    <table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
            @if (!empty($visit_schedulings) && $visit_schedulings->count() > 0)
                <tr>
                    <th scope="col" class="p-2"> Nº </th>
                    <th scope="col" class="p-2"> Cód. </th>
                    <th scope="col" class="p-2"> Visitante </th>
                    <th scope="col" class="p-2"> Data Visita </th>
                    <th scope="col" class="p-2"> Data Agendamento </th>
                    <th scope="col" class="p-2"> Tipo Visita </th>
                    <th scope="col" class="p-2"> Status </th>
                    <th scope="col" class="p-2"> Observações </th>
                    <th scope="col" class="p-2"> Editar </th>
                </tr>
            @endif
        </thead>
        <tbody>
            @forelse ($visit_schedulings as $key=>$visit_scheduling)
                <tr
                    class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
                    <td class="p-2"> {{ $key + 1 }} </td>
                    <td class="p-2"> {{ $visit_scheduling->id }} </td>
                    <td class="p-2"> <a class="text-blue-700"
                            href="{{ route('prisoners.show', $visit_scheduling->prisoner_id) }}">
                            {{ $visit_scheduling->prisoner->name }} </a> </td>
                    <td class="p-2">
                        {{ \Carbon\Carbon::parse($visit_scheduling->date_visit)->format('d/m/Y') }}
                    </td>
                    <td class="p-2">
                        {{ \Carbon\Carbon::parse($visit_scheduling->created_at)->format('d/m/Y - H:i:s') }}
                    </td>
                    <td class="p-2"> {{ $visit_scheduling->type }} </td>
                    <td class="p-2"> {{ $visit_scheduling->status ? 'MANTIDA' : 'CANCELADA' }} </td>
                    <td class="p-2"> {{ $visit_scheduling->remark }} </td>
                    <td class="p-2">
                        {{-- Editar --}}
                        @can('visit_scheduling_update')
                            <div class="group grid justify-items-center w-12">
                                <button wire:click="modalVisitUpdate({{ $visit_scheduling->id }})"
                                    class="p-2 bg-yellow-400 dark:bg-yellow-300/50 hover:opacity-50 transition duration-500 rounded-full">
                                    <x-lucide-pencil class="w-3 h-3 text-zinc-100 dark:text-zinc-200"></x-lucide-pencil>
                                </button>
                            </div>
                        @endcan
                    </td>
                </tr>
            @empty
                <td class="p-2"> Não existe resultado para essa consulta. </td>
            @endforelse
        </tbody>
    </table>

    @include('livewire.main.visitant.includes.visit-modal-update')
</div>
