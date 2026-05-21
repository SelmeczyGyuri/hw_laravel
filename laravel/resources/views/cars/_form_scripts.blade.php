<script>
(function () {

    // ── Extras chips: toggle active class on click ────────────
    document.querySelectorAll('.chip').forEach(function (chip) {
        chip.addEventListener('click', function () {
            chip.classList.toggle('chip--active');
        });
    });

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
                img.style.width   = '100%';
                img.style.height  = '100%';
                img.style.objectFit = 'contain';
                img.style.padding = '4px';
                img.onerror = function () {
                    imgPreview.innerHTML = '<span class="img-preview-placeholder">❌</span>';
                };
                imgPreview.appendChild(img);
                imgPreview.style.borderColor = 'var(--hw-red)';
            } else {
                imgPreview.innerHTML = '<span class="img-preview-placeholder">🚗</span>';
                imgPreview.style.borderColor = '';
            }
        }

        // Fire on every keystroke with a small debounce
        var debounceTimer;
        imgInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                updatePreview(imgInput.value);
            }, 400);
        });

        // Also run on page load (edit page already has a value)
        updatePreview(imgInput.value);
    }

})();
</script>