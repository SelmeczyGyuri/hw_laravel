@extends('layout')

@section('content')

<div class="spec-back-link">
    <a href="{{ route('cars.index') }}" class="btn btn-secondary">← Vissza a listához</a>
</div>

<div class="spec-layout">
 
    {{-- LEFT COLUMN: photo + status + actions --}}
    <aside class="spec-aside">
 
        <div class="spec-img-wrap" id="spec-img-wrap-click" title="Kattints a nagyításhoz">
            @if($car->img_url)
                <img src="{{ $car->img_url }}"
                     alt="{{ $car->name }}"
                     class="spec-img spec-img--clickable"
                     id="spec-img-thumb"
                     onclick="openLightbox()"
                     onerror="this.style.display='none'; document.getElementById('spec-img-fallback').style.display='flex';">
                <div class="spec-img-zoom-hint" aria-hidden="true">🔍</div>
            @endif
            <div id="spec-img-fallback" class="spec-img-fallback" style="{{ $car->img_url ? 'display:none' : 'display:flex' }}">
                🚗
            </div>
        </div>

        {{-- Lightbox modal --}}
        @if($car->img_url)
        <div id="lightbox-overlay" class="lightbox-overlay" role="dialog" aria-modal="true" aria-label="Nagyított kép" onclick="closeLightbox()">
            <button class="lightbox-close" id="lightbox-close-btn" onclick="closeLightbox()" aria-label="Bezárás">✕</button>
            <img src="{{ $car->img_url }}"
                 alt="{{ $car->name }}"
                 class="lightbox-img"
                 id="lightbox-img"
                 onclick="event.stopPropagation()"
                 onerror="closeLightbox()">
        </div>
        @endif
 
        <div class="spec-status-wrap">
            @if($car->isPacked)
                <span class="spec-status spec-status--packed">
                    <span class="spec-status-dot"></span>
                    Bontatlan
                </span>
            @else
                <span class="spec-status spec-status--open">
                    <span class="spec-status-dot"></span>
                    Bontott
                </span>
            @endif
        </div>
 
        @if($car->extras->isNotEmpty())
            <div class="spec-extras-wrap">
                <p class="spec-section-label">Extrák</p>
                <ul class="extras">
                    @foreach($car->extras as $extra)
                        <li>{{ $extra->extra }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
 
        <div class="spec-aside-actions">
            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary spec-btn-full">✏️ Szerkesztés</a>
            <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger spec-btn-full"
                    onclick="return confirm('Biztosan törölni szeretnéd: {{ addslashes($car->name) }}?')">
                    🗑️ Törlés
                </button>
            </form>
        </div>
 
    </aside>
 
    {{-- RIGHT COLUMN: spec sheet --}}
    <div class="spec-main">
 
        <div class="spec-header">
            <div class="spec-toy-code">{{ $car->toy_code }}</div>
            <h1 class="spec-title">
                <span class="title-bar" aria-hidden="true"></span>
                {{ $car->name }}
            </h1>
        </div>
 
        <div class="spec-divider" aria-hidden="true">
            <span class="spec-divider-flag">🏁</span>
        </div>
 
        <dl class="spec-table">
            <div class="spec-row">
                <dt class="spec-label">Szín</dt>
                <dd class="spec-value">
                    <span class="spec-color-dot"></span>
                    {{ $car->color->color }}
                </dd>
            </div>
            <div class="spec-row">
                <dt class="spec-label">Tervező</dt>
                <dd class="spec-value">{{ $car->designer->designer }}</dd>
            </div>
            <div class="spec-row">
                <dt class="spec-label">Kiadás éve</dt>
                <dd class="spec-value spec-value--highlight">{{ $car->year->year }}</dd>
            </div>
            <div class="spec-row">
                <dt class="spec-label">Széria</dt>
                <dd class="spec-value">{{ $car->series->series }}</dd>
            </div>
            @if($car->notes)
            <div class="spec-row spec-row--notes">
                <dt class="spec-label">Megjegyzés</dt>
                <dd class="spec-value spec-value--notes">{{ $car->notes }}</dd>
            </div>
            @endif
        </dl>
 
    </div>
 
</div>

@endsection