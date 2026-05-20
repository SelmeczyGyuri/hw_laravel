@extends('layout')

@section('content')

<h1>Tervezők
    <a href="{{ route('designers.create') }}" title="Új tervező">➕</a>
    <a href="{{ route('designers.index', ['sort_by' => 'designer', 'sort_dir' => 'asc']) }}" title="ABC">🔽</a>
    <a href="{{ route('designers.index', ['sort_by' => 'designer', 'sort_dir' => 'desc']) }}" title="ZYX">🔼</a>
</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<ul>
    @foreach($designers as $designer)
        <li class="actions">
            {{ $designer->designer }}
            <a href="{{ route('designers.show', $designer->id) }}" class="button">Megjelenítés</a>
            <a href="{{ route('designers.edit', $designer->id) }}" class="button">Szerkesztés</a>
            <form action="{{ route('designers.destroy', $designer->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="danger" onclick="return confirm('Biztosan törölni szeretnéd ezt a tervezőt?')">Törlés</button>
            </form>
        </li>
        
    @endforeach
</ul>

@endsection