@extends('layout')

@section('content')

<h1>Szériák
    <a href="{{ route('series.create') }}" title="Új széria">➕</a>
    <a href="{{ route('series.index', ['sort_by' => 'series', 'sort_dir' => 'asc']) }}" title="ABC">🔽</a>
    <a href="{{ route('series.index', ['sort_by' => 'series', 'sort_dir' => 'desc']) }}" title="ZYX">🔼</a>
</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<ul>
    @foreach($series as $serie)
        <li class="actions">
            {{ $serie->series }}
            <a href="{{ route('series.show', $serie->id) }}" class="button">Megjelenítés</a>
            <a href="{{ route('series.edit', $serie->id) }}" class="button">Szerkesztés</a>
            <form action="{{ route('series.destroy', $serie->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="danger" onclick="return confirm('Biztosan törölni szeretnéd ezt a szériát?')">Törlés</button>
            </form>
        </li>
        
    @endforeach
</ul>

@endsection