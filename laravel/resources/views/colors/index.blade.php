@extends('layout')

@section('content')

<h1>
    <span class="title-bar" aria-hidden="true"></span>
    Színek
    <a href="{{ route('colors.create') }}" title="Új szín hozzáadása">➕</a>
    <a href="{{ route('colors.index', ['sort_by' => 'color', 'sort_dir' => 'asc']) }}" title="A–Z rendezés">🔽</a>
    <a href="{{ route('colors.index', ['sort_by' => 'color', 'sort_dir' => 'desc']) }}" title="Z–A rendezés">🔼</a>
</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<p class="swipe-hint" aria-hidden="true">← Húzd balra a törléshez &nbsp;|&nbsp; Húzd jobbra a szerkesztéshez →</p>

<ul class="item-list swipe-list">
    @foreach($colors as $color)
        <li class="swipe-item" data-id="{{ $color->id }}">
            <div class="swipe-bg swipe-bg-edit" aria-hidden="true">
                <span class="swipe-bg-icon">✏️</span>
                <span class="swipe-bg-label">Szerkesztés</span>
            </div>
            <div class="swipe-bg swipe-bg-delete" aria-hidden="true">
                <span class="swipe-bg-label">Törlés</span>
                <span class="swipe-bg-icon">🗑️</span>
            </div>
            <div class="swipe-card item-card">
                <div class="item-name">{{ $color->color }}</div>
                <div class="card-actions">
                    <a href="{{ route('colors.show', $color->id) }}" class="btn btn-primary">Részletek</a>
                    <a href="{{ route('colors.edit', $color->id) }}" class="btn btn-secondary">Szerkesztés</a>
                    <form action="{{ route('colors.destroy', $color->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Biztosan törölni szeretnéd: {{ addslashes($color->color) }}?')">Törlés</button>
                    </form>
                </div>
            </div>
        </li>
    @endforeach
</ul>
 
@include('_swipe_scripts')

@endsection