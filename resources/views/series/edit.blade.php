<x-layout title="Editar Serie '{!! $serie->nome !!}'">
    <a href="{{ route('series.index') }}" class="btn btn-dark mb-2">Ver Series</a> </br>

    <form action="{{ route('series.update', $serie->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" 
                    id="nome" 
                    name="nome" 
                    class="form-control" 
                    value="{{ $serie->nome }}">
        </div>
        <button type="submit" class="btn btn-primary">Alterar</button>
    </form>

</x-layout>