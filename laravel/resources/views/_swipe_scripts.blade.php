<style>
.swipe-hint {
    font-size: 0.78rem;
    color: var(--hw-muted);
    text-align: center;
    letter-spacing: 0.05em;
    margin-bottom: 1.2rem;
    opacity: 0.7;
}
.swipe-item {
    position: relative;
    border-radius: var(--radius-md);
    overflow: hidden;
    cursor: grab;
}
.swipe-item:active { cursor: grabbing; }
.swipe-bg {
    position: absolute; inset: 0;
    display: flex; align-items: center; gap: 0.6rem;
    padding: 0 1.4rem; border-radius: var(--radius-md);
    opacity: 0; transition: opacity 80ms; pointer-events: none; z-index: 0;
}
.swipe-bg-edit  { background: linear-gradient(135deg,#ff6a00,#e8a000); justify-content: flex-start; }
.swipe-bg-delete{ background: linear-gradient(135deg,#9b0000,#e8001c); justify-content: flex-end; }
.swipe-bg-icon  { font-size: 1.5rem; }
.swipe-bg-label {
    font-family: var(--font-display); font-size: 1.1rem; font-weight: 900;
    font-style: italic; text-transform: uppercase; letter-spacing: 0.08em; color: #fff;
}
.swipe-card {
    position: relative; z-index: 1;
    touch-action: pan-y; will-change: transform;
    border-radius: var(--radius-md);
}
.swipe-card.is-returning { transition: transform 300ms cubic-bezier(0.25,1,0.5,1); }
.swipe-item.dragging .swipe-bg-edit,
.swipe-item.dragging .swipe-bg-delete { opacity: 1; }
.card-actions { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; margin-left: auto; }
.card-actions .delete-form { display: inline; }
</style>
 
<script>
(function () {
    var THRESHOLD = 80, MAX_DRAG = 160;
    document.querySelectorAll('.swipe-item').forEach(function (item) {
        var card = item.querySelector('.swipe-card');
        var deleteForm = item.querySelector('.delete-form');
        var editLink = item.querySelector('a.btn-secondary');
        var startX = 0, currentX = 0, isDragging = false;
 
        function onStart(x) {
            startX = x; currentX = 0; isDragging = true;
            item.classList.add('dragging');
            card.classList.remove('is-returning');
        }
        function onMove(x) {
            if (!isDragging) return;
            currentX = Math.max(-MAX_DRAG, Math.min(MAX_DRAG, x - startX));
            card.style.transform = 'translateX(' + currentX + 'px)';
        }
        function onEnd() {
            if (!isDragging) return;
            isDragging = false;
            item.classList.remove('dragging');
            card.classList.add('is-returning');
            if (currentX < -THRESHOLD) {
                card.style.transform = 'translateX(-110%)';
                setTimeout(function () { if (deleteForm) deleteForm.submit(); }, 280);
            } else if (currentX > THRESHOLD) {
                card.style.transform = 'translateX(110%)';
                setTimeout(function () { if (editLink) window.location.href = editLink.href; }, 280);
            } else {
                card.style.transform = 'translateX(0)';
            }
        }
 
        card.addEventListener('touchstart', function (e) { onStart(e.touches[0].clientX); }, { passive: true });
        card.addEventListener('touchmove',  function (e) { onMove(e.touches[0].clientX); },  { passive: true });
        card.addEventListener('touchend', onEnd);
        card.addEventListener('mousedown', function (e) {
            if (e.target.closest('a, button')) return;
            e.preventDefault(); onStart(e.clientX);
            function mm(e) { onMove(e.clientX); }
            function mu() { onEnd(); document.removeEventListener('mousemove', mm); document.removeEventListener('mouseup', mu); }
            document.addEventListener('mousemove', mm);
            document.addEventListener('mouseup', mu);
        });
    });
})();
</script>