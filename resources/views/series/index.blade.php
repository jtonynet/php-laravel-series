<x-layout title="Series">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>

    @isset($mensagemSucesso)
    <div class="alert alert-success">
        {{ $mensagemSucesso }}
    </div>
    @endisset

    <ul class="list-group">
        @foreach ($series as $currentSeries)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $currentSeries->nome }}

                <spen class="d-flex">
                    <form action="{{ route('series.edit', $currentSeries->id) }}" method="get" class="ms-2">
                        <button class="btn btn-primary btn-sm">
                            E
                        </button>
                    </form>

                    <form action="{{ route('series.destroy', $currentSeries->id) }}" method="post" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            X
                        </button>
                    </form>
            </spen>
            </li>
        @endforeach
    </ul>
</x-layout>