@if ($part === 'learn')
    <h2>Living green as a student</h2>
    <p>You don't need to change everything at once. Small habits, repeated every day, add up.</p>
    <div class="grid grid-2" style="margin:14px 0">
        <div class="card"><h3>Energy</h3><p class="mb-0 muted">Switch off lights, fans and the air-conditioner when you leave. Unplug chargers. Use natural light during the day.</p></div>
        <div class="card"><h3>Transport</h3><p class="mb-0 muted">Walk or cycle for short trips. Use buses, LRT or MRT, or carpool to class and events.</p></div>
        <div class="card"><h3>Food</h3><p class="mb-0 muted">Order only what you can finish, bring your own container to tapau, and try more plant-based meals.</p></div>
        <div class="card"><h3>Fashion</h3><p class="mb-0 muted">Rewear, swap or buy pre-loved (bundle) clothes. Buy fewer, better-quality items and repair them.</p></div>
    </div>

    <h3>Grow your own: urban farming</h3>
    <p>Nearly 78% of Malaysians live in urban areas (RTM, 2026). <strong>Urban farming (pertanian bandar)</strong> and <strong>community gardens (kebun komuniti)</strong> let city people grow vegetables close to home. This means less transport and packaging, and food scraps can be turned into compost. A recent programme at Kebun Komuniti Sejahtera Rasah Kemayan showed participants how to make compost from organic waste, organic pesticides and water-saving systems (RTM, 2026).</p>
    <p>Even a small balcony or hostel window can grow herbs like serai (lemongrass), daun kesum or chilli.</p>

    <h3>Be flood-ready</h3>
    <p>With heavier rain, floods can happen quickly. Know your area's risk, keep an emergency bag ready (documents, power bank, torch, medicine, water) and follow official warnings.</p>
@elseif ($part === 'corner')
    <h3 style="margin-top:10px">Agencies that help you live green and stay safe</h3>
    <div class="table-wrap">
        <table class="data">
            <thead><tr><th>Agency</th><th>What it does</th><th>How you can use it</th></tr></thead>
            <tbody>
                <tr><td><a href="https://www.doa.gov.my" target="_blank" rel="noopener">Jabatan Pertanian Malaysia (DOA)</a></td><td>Department of Agriculture: supports crop farming, including urban agriculture</td><td>Look for urban farming guides and programmes to start a small garden</td></tr>
                <tr><td><a href="https://publicinfobanjir.water.gov.my" target="_blank" rel="noopener">Public InfoBanjir (JPS)</a></td><td>Department of Irrigation and Drainage: rainfall and river level information</td><td>Check river levels in your area during heavy rain</td></tr>
                <tr><td><a href="https://www.nadma.gov.my" target="_blank" rel="noopener">NADMA</a></td><td>National Disaster Management Agency</td><td>Follow official disaster updates and preparedness advice</td></tr>
                <tr><td><a href="https://www.met.gov.my" target="_blank" rel="noopener">MetMalaysia</a></td><td>Malaysian Meteorological Department</td><td>Check weather warnings before you travel</td></tr>
            </tbody>
        </table>
    </div>
@elseif ($part === 'summary')
    <ul>
        <li>Save energy, choose low-carbon transport, waste less food and buy fewer new clothes.</li>
        <li>Urban farming cuts food transport and turns food waste into compost.</li>
        <li>Use Public InfoBanjir, NADMA and MetMalaysia to stay safe during floods and extreme weather.</li>
    </ul>
    <p>Ready to put it into practice? Try the <a href="{{ route('challenge') }}">7-Day Green Challenge</a>.</p>
@elseif ($part === 'sources')
    <ul class="sources">
        <li>RTM. (2026, January 19). Tanah terbiar dan rezab bandar dimanfaatkan untuk pertanian bandar. <em>Berita RTM</em>. <a href="https://berita.rtm.gov.my/nasional/senarai-berita-nasional/senarai-artikel/tanah-terbiar-dan-rezab-bandar-dimanfaatkan-untuk-pertanian-bandar/" target="_blank" rel="noopener">Link</a></li>
    </ul>
@endif
