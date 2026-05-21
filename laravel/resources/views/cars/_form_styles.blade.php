<style>
/* ── Form layout ─────────────────────────────────────────── */
.form-back-link { margin-bottom: 1.5rem; }

.race-form { display: flex; flex-direction: column; gap: 1rem; }

/* ── Sections ────────────────────────────────────────────── */
.form-section {
    background: var(--hw-dark-2);
    border: 1px solid var(--hw-border);
    border-radius: var(--radius-lg);
    overflow: hidden;
}

.form-section-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.25rem;
    background: var(--hw-dark-3);
    border-bottom: 1px solid var(--hw-border);
}

.form-section-number {
    font-family: var(--font-display);
    font-size: 0.75rem;
    font-weight: 900;
    font-style: italic;
    letter-spacing: 0.1em;
    color: var(--hw-red);
    background: rgba(232,0,28,0.1);
    border: 1px solid rgba(232,0,28,0.2);
    border-radius: 4px;
    padding: 1px 7px;
    flex-shrink: 0;
}

.form-section-title {
    font-family: var(--font-display);
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--hw-text);
}

.form-section-hint {
    font-size: 0.75rem;
    color: var(--hw-muted);
    margin-left: auto;
}

/* ── Field grid ──────────────────────────────────────────── */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
}

.form-grid--single {
    grid-template-columns: 1fr;
}

.form-field {
    padding: 0.9rem 1.25rem;
    border-right: 1px solid var(--hw-border);
    border-bottom: 1px solid var(--hw-border);
    display: flex;
    flex-direction: column;
    gap: 0.45rem;
}

.form-field:nth-child(even) { border-right: none; }
.form-field:last-child,
.form-field:nth-last-child(-n+2):nth-child(odd) { border-bottom: none; }
.form-grid--single .form-field { border-right: none; border-bottom: none; }

.form-field label {
    font-family: var(--font-display);
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--hw-muted);
    margin: 0;
}

.form-field input[type="text"],
.form-field select,
.form-field textarea {
    background: var(--hw-dark-3);
    border: 1px solid var(--hw-border);
    border-radius: var(--radius-sm);
    color: var(--hw-text);
    font-family: var(--font-body);
    font-size: 0.95rem;
    padding: 0.5rem 0.75rem;
    width: 100%;
    transition: border-color var(--transition);
}

.form-field input:focus,
.form-field select:focus,
.form-field textarea:focus {
    outline: none;
    border-color: var(--hw-red);
}

.form-field input::placeholder { color: #444; }

/* ── Extras chips ────────────────────────────────────────── */
.extras-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    padding: 1rem 1.25rem;
}

.chip {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.35rem 0.9rem;
    border-radius: 999px;
    border: 1px solid var(--hw-border);
    background: var(--hw-dark-3);
    color: var(--hw-muted);
    font-family: var(--font-display);
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    cursor: pointer;
    transition: background var(--transition), border-color var(--transition), color var(--transition);
    user-select: none;
}

.chip input[type="checkbox"] {
    display: none;
}

.chip:hover {
    border-color: #555;
    color: var(--hw-text);
    background: #2a2a2a;
}

.chip--active {
    background: rgba(232,0,28,0.12);
    border-color: rgba(232,0,28,0.4);
    color: #ff6a6a;
}

/* ── Toggle switch (isPacked) ────────────────────────────── */
.form-toggle-row {
    padding: 0.9rem 1.25rem;
    border-top: 1px solid var(--hw-border);
}

.toggle-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    margin: 0;
}

.toggle-text {
    font-family: var(--font-display);
    font-size: 0.95rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--hw-text);
}

.toggle-wrap { position: relative; flex-shrink: 0; }

.toggle-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-track {
    display: block;
    width: 48px;
    height: 26px;
    background: var(--hw-dark-3);
    border: 1px solid var(--hw-border);
    border-radius: 999px;
    position: relative;
    transition: background var(--transition), border-color var(--transition);
}

.toggle-thumb {
    position: absolute;
    top: 3px;
    left: 3px;
    width: 18px;
    height: 18px;
    background: var(--hw-muted);
    border-radius: 50%;
    transition: transform var(--transition), background var(--transition);
}

.toggle-input:checked + .toggle-track {
    background: rgba(232,0,28,0.2);
    border-color: var(--hw-red);
}

.toggle-input:checked + .toggle-track .toggle-thumb {
    transform: translateX(22px);
    background: var(--hw-red);
    box-shadow: 0 0 8px rgba(232,0,28,0.5);
}

/* ── Image preview ───────────────────────────────────────── */
.form-img-row {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 1.25rem;
}

.form-field--grow { flex: 1; padding: 0; border: none; }
.form-field--grow label { margin-bottom: 0.4rem; display: block; }

.img-preview-wrap { flex-shrink: 0; }

.img-preview {
    width: 100px;
    height: 100px;
    background: var(--hw-dark-3);
    border: 1px solid var(--hw-border);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    transition: border-color var(--transition);
}

.img-preview img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 4px;
}

.img-preview-placeholder { font-size: 2.5rem; opacity: 0.3; }

/* ── Error list ──────────────────────────────────────────── */
.error-list {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
}

.error-list li::before {
    content: "— ";
    color: var(--hw-yellow);
    font-weight: 700;
}

/* ── Submit row ──────────────────────────────────────────── */
.form-submit-row {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.75rem;
    padding-top: 0.5rem;
}

.form-submit-btn {
    font-size: 1.05rem;
    padding: 0.6rem 2rem;
}

/* ── Responsive ──────────────────────────────────────────── */
@media (max-width: 640px) {
    .form-grid { grid-template-columns: 1fr; }
    .form-field { border-right: none; border-bottom: 1px solid var(--hw-border); }
    .form-field:last-child { border-bottom: none; }
    .form-section-hint { display: none; }
    .form-submit-row { flex-direction: column-reverse; }
    .form-submit-row .btn { width: 100%; justify-content: center; }
}
</style>