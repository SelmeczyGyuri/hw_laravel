@extends('layout')

@section('content')

<h1>Színek
    <a href="{{ route('colors.create') }}" title="Új szín">➕</a>
    <a href="{{ route('colors.index', ['sort_by' => 'color', 'sort_dir' => 'asc']) }}" title="ABC">🔽</a>
    <a href="{{ route('colors.index', ['sort_by' => 'color', 'sort_dir' => 'desc']) }}" title="ZYX">🔼</a>
</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<ul>
    @foreach($colors as $color)
        <li class="actions">
            {{ $color->color }}
            <a href="{{ route('colors.show', $color->id) }}" class="button">Megjelenítés</a>
            <a href="{{ route('colors.edit', $color->id) }}" class="button">Szerkesztés</a>
            <form action="{{ route('colors.destroy', $color->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="danger" onclick="return confirm('Biztosan törölni szeretnéd ezt a színt?')">Törlés</button>
            </form>
        </li>
        
    @endforeach
</ul>

@endsection