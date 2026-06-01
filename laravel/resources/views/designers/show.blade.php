@extends('layout')

@section('content')
<div class="spec-back-link">
    <a href="{{ route('designers.index') }}" class="btn btn-secondary">← Vissza a listához</a>
</div>
<br>
<h1>
    <span class="title-bar" aria-hidden="true"></span>
    "{{ $designer->designer }}" tervező autói
</h1>

@if($cars->isEmpty())
    <div class="empty-state">
        <span class="empty-state-icon">🚗</span>
        <p>Nincsenek autók ebben a kategóriában.</p>
    </div>
@else
    <p class="swipe-hint" aria-hidden="true">← Húzd balra a törléshez &nbsp;|&nbsp; Húzd jobbra a szerkesztéshez →</p>
 
    <ul class="item-list swipe-list">
        @foreach($cars as $car)
            <li class="swipe-item" data-id="{{ $car->id }}">
                <div class="swipe-bg swipe-bg-edit" aria-hidden="true">
                    <span class="swipe-bg-icon">✏️</span>
                    <span class="swipe-bg-label">Szerkesztés</span>
                </div>
                <div class="swipe-bg swipe-bg-delete" aria-hidden="true">
                    <span class="swipe-bg-label">Törlés</span>
                    <span class="swipe-bg-icon">🗑️</span>
                </div>
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
                                onclick="return confirm('Biztosan törölni szeretnéd: {{ addslashes($car->name) }}?')">Törlés</button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
 
    @include('_swipe_scripts')
@endif

@endsection