<x-layout title="Editar Serie '{{ $serie->nome }}'">
    <a href="{{ route('series.index') }}" class="btn btn-dark mb-2">Ver Series</a> </br>

    <x-series.form :action="route('series.update', $serie->id)" :nome="$serie->nome" :update="true"/>
</x-layout>