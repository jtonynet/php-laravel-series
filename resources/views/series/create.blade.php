<x-layout title="Nova Serie">
    <a href="{{ route('series.index') }}" class="btn btn-dark mb-2">Ver Series</a> </br>

    <form action="{{ route('series.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>