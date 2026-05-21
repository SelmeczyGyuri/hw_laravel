@extends('layout')

@section('content')

<h1>
    <span class="title-bar" aria-hidden="true"></span>
    Tervezők
    <a href="{{ route('designers.create') }}" title="Új hozzáadása">➕</a>
    <a href="{{ route('designers.index', ['sort_by' => 'designer', 'sort_dir' => 'asc']) }}" title="A–Z rendezés">🔽</a>
    <a href="{{ route('designers.index', ['sort_by' => 'designer', 'sort_dir' => 'desc']) }}" title="Z–A rendezés">🔼</a>
</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<p class="swipe-hint" aria-hidden="true">← Húzd balra a törléshez &nbsp;|&nbsp; Húzd jobbra a szerkesztéshez →</p>

<ul class="item-list swipe-list">
    @foreach($designers as $designer)
        <li class="swipe-item" data-id="{{ $designer->id }}">
            <div class="swipe-bg swipe-bg-edit" aria-hidden="true">
                <span class="swipe-bg-icon">✏️</span>
                <span class="swipe-bg-label">Szerkesztés</span>
            </div>
            <div class="swipe-bg swipe-bg-delete" aria-hidden="true">
                <span class="swipe-bg-label">Törlés</span>
                <span class="swipe-bg-icon">🗑️</span>
            </div>
            <div class="swipe-card item-card">
                <div class="item-name">{{ $designer->designer }}</div>
                <div class="card-actions">
                    <a href="{{ route('designers.show', $designer->id) }}" class="btn btn-primary">Részletek</a>
                    <a href="{{ route('designers.edit', $designer->id) }}" class="btn btn-secondary">Szerkesztés</a>
                    <form action="{{ route('designers.destroy', $designer->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Biztosan törölni szeretnéd ezt a tervezőt?')">Törlés</button>
                    </form>
                </div>
            </div>
        </li>
    @endforeach
</ul>
 
@include('_swipe_scripts')

@endsection