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
<!--<ul class="item-list swipe-list" id="carList">
    @foreach($cars as $car)
        <li class="swipe-item" data-id="{{ $car->id }}">
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
</ul>-->

<style>
/* --- Swipe hint ------------------------------------------- */
.swipe-hint {
    font-size: 0.78rem;
    color: var(--hw-muted);
    text-align: center;
    letter-spacing: 0.05em;
    margin-bottom: 1.2rem;
    opacity: 0.7;
}
 
/* --- Swipe list & item wrapper ---------------------------- */
.swipe-list {
    gap: 0.6rem;
}
 
.swipe-item {
    position: relative;
    border-radius: var(--radius-md);
    overflow: hidden;
    /* height collapses to card's height */
    cursor: grab;
}
 
.swipe-item:active { cursor: grabbing; }
 
/* --- Background action panels ----------------------------- */
.swipe-bg {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0 1.4rem;
    border-radius: var(--radius-md);
    opacity: 0;
    transition: opacity 100ms ease;
    pointer-events: none;
    z-index: 0;
}
 
.swipe-bg-edit {
    background: linear-gradient(135deg, #ff6a00, #e8a000);
    justify-content: flex-start;
}
 
.swipe-bg-delete {
    background: linear-gradient(135deg, #9b0000, #e8001c);
    justify-content: flex-end;
}
 
.swipe-bg-icon {
    font-size: 1.5rem;
}
 
.swipe-bg-label {
    font-family: var(--font-display);
    font-size: 1.1rem;
    font-weight: 900;
    font-style: italic;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #fff;
}
 
/* --- The sliding card foreground -------------------------- */
.swipe-card {
    position: relative;
    z-index: 1;
    touch-action: pan-y;
    will-change: transform;
    /* no transition by default — JS adds .is-returning for snap-back */
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}
 
.swipe-card.is-returning {
    transition: transform 300ms cubic-bezier(0.25, 1, 0.5, 1);
}
 
/* show bg panels as soon as card moves */
.swipe-item.dragging .swipe-bg-edit  { opacity: 1; }
.swipe-item.dragging .swipe-bg-delete { opacity: 1; }
 
/* card actions inside the card */
.card-actions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-left: auto;
}
 
.card-actions .delete-form {
    display: inline;
}
</style>
 
<script>
(function () {
    const THRESHOLD = 80;   // px needed to trigger action
    const MAX_DRAG  = 160;  // px maximum visible drag
 
    document.querySelectorAll('.swipe-item').forEach(function (item) {
        const card = item.querySelector('.swipe-card');
        const deleteForm = item.querySelector('.delete-form');
        const editUrl = item.querySelector('a.btn-secondary').href;
 
        let startX = 0;
        let currentX = 0;
        let isDragging = false;
 
        function onStart(x) {
            startX = x;
            currentX = 0;
            isDragging = true;
            item.classList.add('dragging');
            card.classList.remove('is-returning');
        }
 
        function onMove(x) {
            if (!isDragging) return;
            currentX = x - startX;
            // clamp between -MAX_DRAG and +MAX_DRAG
            currentX = Math.max(-MAX_DRAG, Math.min(MAX_DRAG, currentX));
            card.style.transform = 'translateX(' + currentX + 'px)';
        }
 
        function onEnd() {
            if (!isDragging) return;
            isDragging = false;
            item.classList.remove('dragging');
            card.classList.add('is-returning');
 
            if (currentX < -THRESHOLD) {
                // swiped left → DELETE
                // slide card fully off, then submit
                card.style.transform = 'translateX(-110%)';
                setTimeout(function () {
                    deleteForm.submit();
                }, 280);
            } else if (currentX > THRESHOLD) {
                // swiped right → EDIT
                card.style.transform = 'translateX(110%)';
                setTimeout(function () {
                    window.location.href = editUrl;
                }, 280);
            } else {
                // not far enough → snap back
                card.style.transform = 'translateX(0)';
            }
        }
 
        // Touch events
        card.addEventListener('touchstart', function (e) {
            onStart(e.touches[0].clientX);
        }, { passive: true });
 
        card.addEventListener('touchmove', function (e) {
            onMove(e.touches[0].clientX);
        }, { passive: true });
 
        card.addEventListener('touchend', function () {
            onEnd();
        });
 
        // Mouse events (desktop drag)
        card.addEventListener('mousedown', function (e) {
            // don't hijack clicks on buttons/links
            if (e.target.closest('a, button')) return;
            e.preventDefault();
            onStart(e.clientX);
 
            function onMouseMove(e) { onMove(e.clientX); }
            function onMouseUp() {
                onEnd();
                document.removeEventListener('mousemove', onMouseMove);
                document.removeEventListener('mouseup', onMouseUp);
            }
 
            document.addEventListener('mousemove', onMouseMove);
            document.addEventListener('mouseup', onMouseUp);
        });
    });
})();
</script>

@endsection