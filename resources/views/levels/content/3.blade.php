@if ($part === 'learn')
    <h2>The waste hierarchy: Reduce, Reuse, Recycle</h2>
    <p>Not all ways of dealing with waste are equal. The best waste is waste that is never created.</p>
    <div class="table-wrap">
        <table class="data">
            <thead><tr><th>Step</th><th>What it means</th><th>Student example</th></tr></thead>
            <tbody>
                <tr><td><strong>1. Reduce</strong> (best)</td><td>Use less and avoid waste in the first place</td><td>Say no to plastic straws and bags; bring a tumbler</td></tr>
                <tr><td><strong>2. Reuse</strong></td><td>Use items again instead of throwing them away</td><td>Use your own container when you tapau</td></tr>
                <tr><td><strong>3. Recycle</strong></td><td>Turn used materials into new products</td><td>Separate paper, plastic, cans and glass</td></tr>
                <tr><td><strong>4. Dispose</strong> (last)</td><td>Send to landfill only what cannot be avoided, reused or recycled</td><td>Used tissues, dirty packaging</td></tr>
            </tbody>
        </table>
    </div>

    <h3>Why separate your waste?</h3>
    <p>When recyclables are mixed with food waste, they get dirty and often cannot be recycled. Separating waste at source (at home, in the hostel or at the café) keeps materials clean so they can be recycled. Food waste can be composted into fertiliser instead of rotting in a landfill and releasing methane.</p>
    <div class="callout">
        <strong>Before you recycle:</strong> empty and rinse bottles and cans, flatten boxes, and keep paper dry. Recycling rules can differ slightly between local councils, so check the bins in your area.
    </div>
@elseif ($part === 'corner')
    <h3 style="margin-top:10px">Malaysia's waste in numbers</h3>
    <div class="facts">
        <div class="fact"><span class="big">15.2 mil</span>tonnes of solid waste generated in Malaysia in 2024 <span class="cite">(Dzulkifli, 2026)</span></div>
        <div class="fact"><span class="big">~40%</span>of landfilled waste has recycling potential <span class="cite">(Dzulkifli, 2026)</span></div>
        <div class="fact"><span class="big">37.9%</span>national recycling rate in 2024, up from 35.38% in 2023 <span class="cite">(Dzulkifli, 2026)</span></div>
        <div class="fact"><span class="big">20.55%</span>of landfill waste is plastic, and 10.17% is paper <span class="cite">(Dzulkifli, 2026)</span></div>
    </div>
    <p><strong>SWCorp</strong> (Perbadanan Pengurusan Sisa Pepejal dan Pembersihan Awam), under the Ministry of Housing and Local Government (KPKT), manages solid waste and public cleansing. In 2025 it ran 14,650 awareness programmes and is working on household separation at source, reverse vending machines and Extended Producer Responsibility (Dzulkifli, 2026).</p>
    <p class="mb-0">Learn more on the <a href="https://www.swcorp.gov.my" target="_blank" rel="noopener">SWCorp website</a>.</p>
@elseif ($part === 'summary')
    <ul>
        <li>Reduce first, then reuse, then recycle. Landfill is the last option.</li>
        <li>Separate waste at source and keep recyclables clean; compost food waste.</li>
        <li>Malaysia recycled 37.9% of its waste in 2024, and nearly 40% of landfilled waste could still be recycled.</li>
    </ul>
@elseif ($part === 'sources')
    <ul class="sources">
        <li>Dzulkifli, S. (2026, April 23). 40% of Malaysia's trash is recyclable. <em>Asia News Network</em>. <a href="https://asianews.network/40-of-malaysias-trash-is-recyclable/" target="_blank" rel="noopener">Link</a></li>
    </ul>
@endif
