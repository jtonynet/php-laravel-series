<x-layout title="Series" :mensagem-sucesso="$mensagemSucesso">
    @auth
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    <ul class="list-group">
        @foreach ($series as $currentSeries)
            <li class="list-group-item d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . $currentSeries->cover)}}" 
                        alt="Capa da Serie"
                        style="height:150px" 
                        class="img-thumbnail me-3">

                    @auth<a href="{{ route('seasons.index', $currentSeries->id) }}">@endauth
                            {{ $currentSeries->nome }}
                    @auth</a>@endauth
                </div>

                @auth
                <span class="d-flex">
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
                </span>
                @endauth
            </li>
        @endforeach
    </ul>
</x-layout>