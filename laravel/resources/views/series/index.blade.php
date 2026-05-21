@extends('layout')

@section('content')

<h1>
    <span class="title-bar" aria-hidden="true"></span>
    Szériák
    <a href="{{ route('series.create') }}" title="Új hozzáadása">➕</a>
    <a href="{{ route('series.index', ['sort_by' => 'series', 'sort_dir' => 'asc']) }}" title="A–Z rendezés">🔽</a>
    <a href="{{ route('series.index', ['sort_by' => 'series', 'sort_dir' => 'desc']) }}" title="Z–A rendezés">🔼</a>
</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<p class="swipe-hint" aria-hidden="true">← Húzd balra a törléshez &nbsp;|&nbsp; Húzd jobbra a szerkesztéshez →</p>
 
<ul class="item-list swipe-list">
    @foreach($series as $series)
        <li class="swipe-item" data-id="{{ $series->id }}">
            <div class="swipe-bg swipe-bg-edit" aria-hidden="true">
                <span class="swipe-bg-icon">✏️</span>
                <span class="swipe-bg-label">Szerkesztés</span>
            </div>
            <div class="swipe-bg swipe-bg-delete" aria-hidden="true">
                <span class="swipe-bg-label">Törlés</span>
                <span class="swipe-bg-icon">🗑️</span>
            </div>
            <div class="swipe-card item-card">
                <div class="item-name">{{ $series->series }}</div>
                <div class="card-actions">
                    <a href="{{ route('series.show', $series->id) }}" class="btn btn-primary">Részletek</a>
                    <a href="{{ route('series.edit', $series->id) }}" class="btn btn-secondary">Szerkesztés</a>
                    <form action="{{ route('series.destroy', $series->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Biztosan törölni szeretnéd ezt a szériát?')">Törlés</button>
                    </form>
                </div>
            </div>
        </li>
    @endforeach
</ul>
 
@include('_swipe_scripts')


@endsection