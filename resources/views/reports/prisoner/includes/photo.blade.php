{{-- Photos --}}
@if (isset($prisoner->photos) && $prisoner->photos->count() > 0)
<div class="pb-2">
  {{-- Título --}}
  <h1 class="title">FOTOS</h1>
  {{-- Conteúdo --}}
  <div style="width: 100%; margin-top: 57px; text-align: center;">
    @foreach ($prisoner->photos as $photo)
    <div style="width: 23%; display:inline-block; margin-right: 1%; margin-bottom: 20px;">
      {{-- imagem --}}
      <img src="{{ storage_path('app/public/' . $photo->photo) }}" style="width: 100%; height: 200px; border-radius: 10px;">
      {{-- descrição --}}
      <div class="item_span" style="text-align: center; margin-top: 4px; height: 30px;">{{ $photo->description }}</div>
    </div>
    @endforeach
  </div>
</div>
@endif