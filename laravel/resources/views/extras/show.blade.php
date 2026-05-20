@extends('layout')

@section('content')
<h1>"{{ $extra->extra }}" extra részletei</h1>

<ul>
    @foreach($cars as $car)
        <li class="actions">
            {{ $car->name }}
            <ul class="extras">
                @foreach($car->extras as $extra)
                    <li>{{ $extra->extra }}</li>
                @endforeach
            </ul>
            <a href="{{ route('cars.show', $car->id) }}" class="button">Megjelenítés</a>
            <a href="{{ route('cars.edit', $car->id) }}" class="button">Szerkesztés</a>
            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="danger" onclick="return confirm('Biztosan törölni szeretnéd ezt az autót?')">Törlés</button>
            </form>
        </li>
        
    @endforeach
</ul>

@endsection