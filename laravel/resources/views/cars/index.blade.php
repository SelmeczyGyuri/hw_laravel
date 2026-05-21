@extends('layout')

@section('content')

<h1>
    <span class="title-bar" aria-hidden="true"></span>
    Autók
    <a href="{{ route('cars.create') }}" title="Új autó hozzáadása">➕</a>
    <a href="{{ route('cars.index', ['sort_by' => 'name', 'sort_dir' => 'asc']) }}" title="A–Z rendezés">🔽</a>
    <a href="{{ route('cars.index', ['sort_by' => 'name', 'sort_dir' => 'desc']) }}" title="Z–A rendezés">🔼</a>
</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<p class="swipe-hint" aria-hidden="true">
    ← Húzd balra a törléshez &nbsp;|&nbsp; Húzd jobbra a szerkesztéshez →
</p>

<ul class="item-list swipe-list" id="carList">
    @foreach($cars as $car)
        <li class="swipe-item" data-id="{{ $car->id }}">
 
            {{-- Background panels revealed on swipe --}}
            <div class="swipe-bg swipe-bg-edit" aria-hidden="true">
                <span class="swipe-bg-icon">✏️</span>
                <span class="swipe-bg-label">Szerkesztés</span>
            </div>
            <div class="swipe-bg swipe-bg-delete" aria-hidden="true">
                <span class="swipe-bg-label">Törlés</span>
                <span class="swipe-bg-icon">🗑️</span>
            </div>
 
            {{-- The draggable card foreground --}}
            <div class="swipe-card item-card">
                <div class="item-name">{{ $car->name }}</div>
 
                @if($car->extras->isNotEmpty())
                    <ul class="extras" aria-label="Extrák">
                        @foreach($car->extras as $extra)
                            <li>{{ $extra->extra }}</li>
                        @endforeach
                    </ul>
                @endif
 
                <div class="card-actions">
                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Részletek</a>
                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-secondary">Szerkesztés</a>
                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Biztosan törölni szeretnéd: {{ addslashes($car->name) }}?')">
                            Törlés
                        </button>
                    </form>
                </div>
            </div>
 
        </li>
    @endforeach
</ul>
 
@include('_swipe_scripts')

@endsection