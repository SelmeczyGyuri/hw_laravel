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

{{-- Search / filter bar --}}
<div class="filter-bar">
    <div class="filter-input-wrap">
        <span class="filter-icon">🔍</span>
        <input type="text"
               id="filterInput"
               class="filter-input"
               placeholder="Szűrés autó neve alapján…"
               autocomplete="off"
               aria-label="Autók szűrése">
        <button class="filter-clear" id="filterClear" aria-label="Szűrő törlése">✕</button>
    </div>
    <p class="filter-count" id="filterCount" aria-live="polite"></p>
</div>

<p class="swipe-hint" aria-hidden="true">
    ← Húzd balra a törléshez &nbsp;|&nbsp; Húzd jobbra a szerkesztéshez →
</p>

<ul class="item-list swipe-list" id="carList">
    @foreach($cars as $car)
        <li class="swipe-item" data-name="{{ strtolower($car->name) }}" data-id="{{ $car->id }}">
 
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
                            onclick="return confirm('Biztosan törölni szeretnéd: {{ addslashes($car->name) }}?')">
                            Törlés
                        </button>
                    </form>
                </div>
            </div>
 
        </li>
    @endforeach
</ul>

{{-- Empty state shown when filter has no matches --}}
<div class="filter-empty" id="filterEmpty" style="display:none;">
    <span class="filter-empty-icon">🔍</span>
    <p id="filterEmptyText"></p>
</div>

@include('_swipe_scripts')

@endsection