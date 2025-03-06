{{-- Linha 1 --}}
<div class="md:flex md:gap-6 mt-6 w-[90%] md:w-[50%] mx-auto">
    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" name="start_date" />
        <x-label for="start_date" value="{{ 'DATA INICIAL' }}" />
    </div>

    <div class="col-span-1 relative z-0 w-full group">
        <x-input type="date" name="end_date" />
        <x-label for="end_date" value="{{ 'DATA FINAL' }}" />
    </div>
</div>
