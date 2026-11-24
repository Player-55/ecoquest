<p class="muted">Sort 10 items into the right bin. Read the feedback after each one: it explains why.</p>
<div data-activity="sort">
    <div class="score-line"><span class="sort-progress">Item 1 of 10</span><span class="sort-score">Score: 0</span></div>
    <div class="sort-item" aria-live="polite">Loading…</div>
    <div class="bins">
        <button type="button" class="bin" data-bin="paper">
            <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="#1D4ED8" stroke-width="2"><path d="M6 3h9l3 3v15H6z"/><path d="M9 9h6M9 13h6M9 17h4"/></svg>Paper
        </button>
        <button type="button" class="bin" data-bin="plastic">
            <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="#C2410C" stroke-width="2"><path d="M9 2h6v3l2 3v13H7V8l2-3z"/></svg>Plastic &amp; metal
        </button>
        <button type="button" class="bin" data-bin="glass">
            <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="#7C4A21" stroke-width="2"><path d="M10 2h4v4l2 3v13H8V9l2-3z"/></svg>Glass
        </button>
        <button type="button" class="bin" data-bin="food">
            <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="#15803D" stroke-width="2"><path d="M12 21c-5 0-8-4-8-9 4 0 8 3 8 9zM12 21c5 0 8-4 8-9-4 0-8 3-8 9zM12 12V3"/></svg>Food waste (compost)
        </button>
        <button type="button" class="bin" data-bin="general">
            <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="#475569" stroke-width="2"><path d="M4 6h16M9 6V3h6v3M6 6l1 15h10l1-15"/></svg>General waste
        </button>
    </div>
    <div class="sort-feedback" aria-live="polite"></div>
    <div class="sort-end" hidden>
        <p class="sort-final" style="font-weight:600"></p>
        <button type="button" class="btn btn-outline sort-again">Play again</button>
    </div>
</div>
