@extends('layout')

@section('content')

<h1>Extrák
    <a href="{{ route('extras.create') }}" title="Új extra">➕</a>
    <a href="{{ route('extras.index', ['sort_by' => 'extra', 'sort_dir' => 'asc']) }}" title="ABC">🔽</a>
    <a href="{{ route('extras.index', ['sort_by' => 'extra', 'sort_dir' => 'desc']) }}" title="ZYX">🔼</a>
</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<ul>
    @foreach($extras as $extra)
        <li class="actions">
            {{ $extra->extra }}
            <a href="{{ route('extras.show', $extra->id) }}" class="button">Megjelenítés</a>
            <a href="{{ route('extras.edit', $extra->id) }}" class="button">Szerkesztés</a>
            <form action="{{ route('extras.destroy', $extra->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="danger" onclick="return confirm('Biztosan törölni szeretnéd ezt az extrát?')">Törlés</button>
            </form>
        </li>
        
    @endforeach
</ul>

@endsection