@extends('layout')

@section('content')

<div class="spec-back-link">
    <a href="{{ route('cars.index') }}" class="btn btn-secondary">← Vissza a listához</a>
</div>

<div class="spec-layout">
 
    {{-- LEFT COLUMN: photo + status + actions --}}
    <aside class="spec-aside">
 
        <div class="spec-img-wrap">
            @if($car->img_url)
                <img src="{{ $car->img_url }}"
                     alt="{{ $car->name }}"
                     class="spec-img"
                     onerror="this.style.display='none'; document.getElementById('spec-img-fallback').style.display='flex';">
            @endif
            <div id="spec-img-fallback" class="spec-img-fallback" style="{{ $car->img_url ? 'display:none' : 'display:flex' }}">
                🚗
            </div>
        </div>
 
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


<style>
/* --- Layout ----------------------------------------------- */
.spec-back-link {
    margin-bottom: 1.5rem;
}
 
.spec-layout {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 2rem;
    align-items: start;
}
 
/* --- Aside ------------------------------------------------ */
.spec-aside {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
}
 
.spec-img-wrap {
    width: 100%;
    aspect-ratio: 1;
    background: var(--hw-dark-2);
    border: 1px solid var(--hw-border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}
 
.spec-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 1rem;
    transition: transform 400ms ease;
}
 
.spec-img-wrap:hover .spec-img {
    transform: scale(1.06) rotate(-2deg);
}
 
.spec-img-fallback {
    font-size: 5rem;
    width: 100%;
    height: 100%;
    align-items: center;
    justify-content: center;
    color: var(--hw-border);
}
 
/* --- Status badge ----------------------------------------- */
.spec-status-wrap {
    text-align: center;
}
 
.spec-status {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.4rem 1.1rem;
    border-radius: 999px;
    font-family: var(--font-display);
    font-size: 0.95rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}
 
.spec-status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    animation: pulse-dot 2s ease-in-out infinite;
}
 
.spec-status--packed {
    background: rgba(0,200,80,0.1);
    color: #7fffb2;
    border: 1px solid rgba(0,200,80,0.25);
}
 
.spec-status--packed .spec-status-dot {
    background: #00c850;
    box-shadow: 0 0 6px #00c850;
}
 
.spec-status--open {
    background: rgba(255,106,0,0.1);
    color: #ffb366;
    border: 1px solid rgba(255,106,0,0.25);
}
 
.spec-status--open .spec-status-dot {
    background: var(--hw-orange);
    box-shadow: 0 0 6px var(--hw-orange);
}
 
@keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(0.75); }
}
 
/* --- Extras in aside ------------------------------------- */
.spec-extras-wrap {
    background: var(--hw-dark-2);
    border: 1px solid var(--hw-border);
    border-radius: var(--radius-md);
    padding: 0.9rem 1rem;
}
 
.spec-section-label {
    font-family: var(--font-display);
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--hw-muted);
    margin-bottom: 0.5rem;
}
 
/* --- Aside action buttons --------------------------------- */
.spec-aside-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}
 
.spec-aside-actions form {
    margin: 0;
}
 
.spec-btn-full {
    width: 100%;
    justify-content: center;
    padding: 0.6rem 1rem;
    font-size: 1rem;
}
 
/* --- Main spec sheet -------------------------------------- */
.spec-main {
    background: var(--hw-dark-2);
    border: 1px solid var(--hw-border);
    border-radius: var(--radius-lg);
    overflow: hidden;
}
 
.spec-header {
    padding: 1.5rem 1.8rem 1rem;
    background: var(--hw-dark-3);
    border-bottom: 1px solid var(--hw-border);
    position: relative;
    overflow: hidden;
}
 
/* diagonal speed-stripe behind header */
.spec-header::before {
    content: '';
    position: absolute;
    right: -40px;
    top: -20px;
    width: 160px;
    height: 160px;
    background: linear-gradient(135deg, var(--hw-red), var(--hw-orange));
    opacity: 0.07;
    transform: rotate(20deg);
    border-radius: 20px;
}
 
.spec-toy-code {
    font-family: var(--font-display);
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--hw-red);
    margin-bottom: 0.3rem;
}
 
.spec-title {
    font-size: clamp(1.6rem, 4vw, 2.4rem);
    margin-bottom: 0;
}
 
/* --- Divider ---------------------------------------------- */
.spec-divider {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    padding: 0 1.8rem;
    margin: 0;
    border-bottom: 1px solid var(--hw-border);
    background: var(--hw-dark-3);
    height: 32px;
}
 
.spec-divider::before,
.spec-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--hw-border));
}
 
.spec-divider::after {
    background: linear-gradient(90deg, var(--hw-border), transparent);
}
 
.spec-divider-flag {
    font-size: 1rem;
    line-height: 1;
}
 
/* --- Spec table ------------------------------------------- */
.spec-table {
    padding: 0.5rem 0;
}
 
.spec-row {
    display: grid;
    grid-template-columns: 130px 1fr;
    align-items: baseline;
    border-bottom: 1px solid var(--hw-border);
    padding: 0.75rem 1.8rem;
    transition: background var(--transition);
}
 
.spec-row:last-child {
    border-bottom: none;
}
 
.spec-row:hover {
    background: rgba(255,255,255,0.02);
}
 
.spec-label {
    font-family: var(--font-display);
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--hw-muted);
}
 
.spec-value {
    font-size: 1rem;
    color: var(--hw-text);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
 
.spec-value--highlight {
    font-family: var(--font-display);
    font-size: 1.3rem;
    font-weight: 900;
    font-style: italic;
    color: var(--hw-yellow);
    letter-spacing: 0.05em;
}
 
.spec-value--notes {
    font-size: 0.92rem;
    color: #aaa;
    font-style: italic;
    line-height: 1.5;
}
 
.spec-row--notes {
    align-items: start;
    padding-top: 1rem;
    padding-bottom: 1rem;
}
 
.spec-color-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--hw-grad);
    flex-shrink: 0;
}
 
/* --- Responsive ------------------------------------------- */
@media (max-width: 640px) {
    .spec-layout {
        grid-template-columns: 1fr;
    }
 
    .spec-img-wrap {
        max-width: 220px;
        margin: 0 auto;
    }
 
    .spec-row {
        grid-template-columns: 110px 1fr;
        padding: 0.65rem 1.2rem;
    }
}
</style>

@endsection