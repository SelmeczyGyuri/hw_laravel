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


function openLightbox() {
    const overlay = document.getElementById('lightbox-overlay');
    if (!overlay) return;
    overlay.classList.add('is-open');
    document.body.style.overflow = 'hidden';
    document.getElementById('lightbox-close-btn').focus();
}

function closeLightbox() {
    const overlay = document.getElementById('lightbox-overlay');
    if (!overlay) return;
    overlay.classList.remove('is-open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
});

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