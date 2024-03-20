<x-report-layout>
   <h1>{{ $ward->ward }}</h1>

   @foreach ($ward->cells as $cell)
      {{ $cell->cell }}
   @endforeach
   
</x-report-layout>