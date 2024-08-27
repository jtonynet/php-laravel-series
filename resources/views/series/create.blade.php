<x-layout title="Nova Serie">
    <a href="{{ route('series.index') }}" class="btn btn-dark mb-2">Ver Series</a> </br>

    <x-series.form :action="route('series.store')" />
</x-layout>