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

<style>
/* ── Filter bar ─────────────────────────────────────────────── */
.filter-bar {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}
 
.filter-input-wrap {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--hw-dark-2);
    border: 1px solid var(--hw-border);
    border-radius: var(--radius-md);
    padding: 0.5rem 0.85rem;
    flex: 1;
    max-width: 420px;
    transition: border-color 200ms ease;
}
 
.filter-input-wrap:focus-within {
    border-color: var(--hw-red);
}
 
.filter-icon {
    font-size: 1rem;
    opacity: 0.45;
    flex-shrink: 0;
}
 
.filter-input {
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    color: var(--hw-text);
    font-family: var(--font-body);
    font-size: 0.95rem;
    padding: 0;
    min-width: 0;
}
 
.filter-input::placeholder { color: #444; }
 
.filter-clear {
    background: none;
    border: none;
    color: var(--hw-muted);
    font-size: 0.8rem;
    cursor: pointer;
    padding: 0;
    line-height: 1;
    opacity: 0;
    pointer-events: none;
    transition: opacity 150ms, color 150ms;
    flex-shrink: 0;
}
 
.filter-clear.visible {
    opacity: 1;
    pointer-events: all;
}
 
.filter-clear:hover { color: var(--hw-text); }
 
.filter-count {
    font-family: var(--font-display);
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--hw-muted);
    white-space: nowrap;
}
 
.filter-count.has-results { color: var(--hw-orange); }
 
/* ── Filtered-out items ─────────────────────────────────────── */
.swipe-item.hidden {
    display: none;
}
 
/* ── Highlight matching text ────────────────────────────────── */
.item-name mark {
    background: transparent;
    color: var(--hw-orange);
    font-style: normal;
}
 
/* ── Empty state ────────────────────────────────────────────── */
.filter-empty {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--hw-muted);
}
 
.filter-empty-icon {
    display: block;
    font-size: 2.5rem;
    margin-bottom: 0.75rem;
    opacity: 0.4;
}
 
.filter-empty p {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
}
</style>

<script>
(function () {
    var input     = document.getElementById('filterInput');
    var clearBtn  = document.getElementById('filterClear');
    var countEl   = document.getElementById('filterCount');
    var emptyEl   = document.getElementById('filterEmpty');
    var emptyText = document.getElementById('filterEmptyText');
    var items     = Array.from(document.querySelectorAll('.swipe-item'));
    var total     = items.length;

    items.forEach(function (item) {
        item._originalName = item.querySelector('.item-name').textContent.trim();
    });

    function escapeRegex(str) { return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); }

    function filter(query) {
        var q = query.trim().toLowerCase();
        var visibleCount = 0;

        items.forEach(function (item) {
            var nameEl = item.querySelector('.item-name');
            if (q === '' || item.dataset.name.includes(q)) {
                item.classList.remove('hidden');
                nameEl.innerHTML = q === '' ? item._originalName
                    : item._originalName.replace(new RegExp('(' + escapeRegex(query.trim()) + ')', 'gi'), '<mark>$1</mark>');
                visibleCount++;
            } else {
                item.classList.add('hidden');
                nameEl.innerHTML = item._originalName;
            }
        });

        countEl.textContent = q === '' ? '' : visibleCount + ' / ' + total + ' autó';
        countEl.classList.toggle('has-results', q !== '' && visibleCount > 0);
        emptyEl.style.display = (q !== '' && visibleCount === 0) ? 'block' : 'none';
        if (q !== '' && visibleCount === 0)
            document.getElementById('filterEmptyText').textContent = '"' + query.trim() + '" — nincs ilyen autó';
    }

    input.addEventListener('input', function () {
        clearBtn.classList.toggle('visible', input.value.length > 0);
        filter(input.value);
    });

    clearBtn.addEventListener('click', function () {
        input.value = ''; clearBtn.classList.remove('visible'); filter(''); input.focus();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === '/' && document.activeElement !== input) { e.preventDefault(); input.focus(); }
        if (e.key === 'Escape' && document.activeElement === input) { input.value = ''; clearBtn.classList.remove('visible'); filter(''); input.blur(); }
    });
})();
</script>

@include('_swipe_scripts')

@endsection