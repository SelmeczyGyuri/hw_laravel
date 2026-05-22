<script>
(function () {

    // ── Extras chips: sync active class with checkbox state ───
    // The label wraps a hidden checkbox. Clicking the label toggles
    // the checkbox natively — we just reflect that state visually.
    function syncChips() {
        document.querySelectorAll('.chip').forEach(function (chip) {
            var checkbox = chip.querySelector('input[type="checkbox"]');
            if (!checkbox) return;

            // Set initial visual state from checkbox
            if (checkbox.checked) {
                chip.classList.add('chip--active');
            } else {
                chip.classList.remove('chip--active');
            }

            // Update visual state whenever the checkbox changes
            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    chip.classList.add('chip--active');
                } else {
                    chip.classList.remove('chip--active');
                }
            });
        });
    }

    syncChips();

    // ── Image URL: live preview ───────────────────────────────
    var imgInput   = document.getElementById('img_url');
    var imgPreview = document.getElementById('imgPreview');

    if (imgInput && imgPreview) {

        function updatePreview(url) {
            imgPreview.innerHTML = '';
            if (url && url.trim() !== '') {
                var img = document.createElement('img');
                img.src = url.trim();
                img.alt = 'Előnézet';
                img.style.width     = '100%';
                img.style.height    = '100%';
                img.style.objectFit = 'contain';
                img.style.padding   = '4px';
                img.onerror = function () {
                    imgPreview.innerHTML = '<span class="img-preview-placeholder">❌</span>';
                    imgPreview.style.borderColor = '';
                };
                img.onload = function () {
                    imgPreview.style.borderColor = 'var(--hw-red)';
                };
                imgPreview.appendChild(img);
            } else {
                imgPreview.innerHTML = '<span class="img-preview-placeholder">🚗</span>';
                imgPreview.style.borderColor = '';
            }
        }

        var debounceTimer;
        imgInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                updatePreview(imgInput.value);
            }, 400);
        });

        // Run on load so edit page shows existing image immediately
        updatePreview(imgInput.value);
    }

})();
</script>