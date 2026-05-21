<style>
.simple-form-wrap {
    max-width: 520px;
}

.simple-form {
    background: var(--hw-dark-2);
    border: 1px solid var(--hw-border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    margin-bottom: 1rem;
}

.simple-form-body {
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.simple-form-body label {
    font-family: var(--font-display);
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--hw-muted);
    margin: 0;
}

.simple-form-body input[type="text"],
.simple-form-body input[type="number"] {
    background: var(--hw-dark-3);
    border: 1px solid var(--hw-border);
    border-radius: var(--radius-sm);
    color: var(--hw-text);
    font-family: var(--font-body);
    font-size: 1rem;
    padding: 0.6rem 0.9rem;
    width: 100%;
    transition: border-color 200ms ease;
}

.simple-form-body input:focus {
    outline: none;
    border-color: var(--hw-red);
}

.simple-form-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.25rem;
    background: var(--hw-dark-3);
    border-top: 1px solid var(--hw-border);
    justify-content: flex-end;
}
</style>