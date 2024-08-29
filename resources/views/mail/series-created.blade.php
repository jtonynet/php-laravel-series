@component('mail::message')

# {{ $nomeSerie }} criada

A Serie {{ $nomeSerie }} com {{ $qtdTemporadas }} temporadas e {{ $episodiosPorTemporada }} episodios por temporada

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $idSerie)])
    Ver Serie
@endcomponent


@endcomponent
