@extends('layout')

@section('content')

<h1>Gyártási évek
    <a href="{{ route('years.create') }}" title="Új szín">➕</a>
    <a href="{{ route('years.index', ['sort_by' => 'year', 'sort_dir' => 'asc']) }}" title="ABC">🔽</a>
    <a href="{{ route('years.index', ['sort_by' => 'year', 'sort_dir' => 'desc']) }}" title="ZYX">🔼</a>
</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<ul>
    @foreach($years as $year)
        <li class="actions">
            {{ $year->year }}
            <a href="{{ route('years.show', $year->id) }}" class="button">Megjelenítés</a>
            <a href="{{ route('years.edit', $year->id) }}" class="button">Szerkesztés</a>
            <form action="{{ route('years.destroy', $year->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="danger" onclick="return confirm('Biztosan törölni szeretnéd ezt a gyártási évet?')">Törlés</button>
            </form>
        </li>
        
    @endforeach
</ul>

@endsection