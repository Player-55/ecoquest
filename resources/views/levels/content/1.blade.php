@if ($part === 'learn')
    <h2>Weather vs climate</h2>
    <p><strong>Weather</strong> is what happens outside today: sunny, rainy or stormy. <strong>Climate</strong> is the average weather pattern of a place over a long time, usually 30 years or more. Climate change means these long-term patterns are shifting: hotter temperatures, heavier rain and more extreme events.</p>

    <h3>How the greenhouse effect works</h3>
    <figure class="mb-0">
        <svg class="greenhouse" viewBox="0 0 560 300" role="img" aria-label="Diagram: sunlight passes through the atmosphere, the Earth gives off heat, and greenhouse gases trap part of that heat">
            <rect x="0" y="0" width="560" height="300" rx="16" fill="#E0F2FE"/>
            <rect x="0" y="70" width="560" height="54" fill="#94A3B8" opacity=".35"/>
            <text x="440" y="102" font-size="13" fill="#334155" font-family="Inter, sans-serif">Greenhouse gases</text>
            <circle cx="70" cy="40" r="26" fill="#F59E0B"/>
            <path d="M0 250 Q280 205 560 250 V300 H0z" fill="#4CAF50"/>
            <path class="ray-in" d="M92 58 L220 238" stroke="#F59E0B" stroke-width="4" fill="none"/>
            <path class="ray-out" d="M240 236 L320 40" stroke="#DC2626" stroke-width="4" fill="none"/>
            <path class="ray-trap" d="M300 238 L360 104 L410 236" stroke="#DC2626" stroke-width="4" fill="none"/>
            <g font-family="Inter, sans-serif" font-size="14" font-weight="700" fill="#fff">
                <circle cx="132" cy="112" r="13" fill="#B45309"/><text x="132" y="117" text-anchor="middle">1</text>
                <circle cx="306" cy="118" r="13" fill="#B91C1C"/><text x="306" y="123" text-anchor="middle">2</text>
                <circle cx="402" cy="150" r="13" fill="#B91C1C"/><text x="402" y="155" text-anchor="middle">3</text>
            </g>
            <text x="280" y="284" text-anchor="middle" font-size="13" fill="#fff" font-family="Inter, sans-serif">1 Sunlight comes in · 2 Earth gives off heat · 3 Greenhouse gases trap some heat</text>
        </svg>
        <figcaption class="small muted center">More greenhouse gases = more heat trapped = a warmer planet.</figcaption>
    </figure>
    <p>Gases such as carbon dioxide (CO₂) and methane act like a blanket around the Earth. Some of this is natural and keeps the planet warm enough to live on. But human activities have added much more of these gases, so the blanket is getting thicker and the Earth is heating up.</p>

    <h3>What causes it?</h3>
    <ul>
        <li><strong>Burning fossil fuels:</strong> coal, oil and gas for electricity, cars and factories release CO₂.</li>
        <li><strong>Cutting down forests:</strong> fewer trees are left to absorb CO₂, and burning forests releases stored carbon.</li>
        <li><strong>Waste in landfills:</strong> rotting food and organic waste release methane.</li>
        <li><strong>Agriculture:</strong> some farming activities release methane and other greenhouse gases.</li>
    </ul>

    <h3>Myth or fact?</h3>
    <p class="muted">Test what you think before reading on. Tap an answer to get instant feedback.</p>
    <div class="mf" data-mythfact>
        <div class="mf-item" data-answer="myth" data-explain="Natural factors do affect the climate, but the rapid warming seen today is mainly caused by human activities such as burning fossil fuels.">
            <strong>"Climate change is completely natural. Humans have nothing to do with it."</strong>
            <div class="mf-buttons"><button type="button" class="btn btn-outline btn-sm" data-pick="myth">Myth</button><button type="button" class="btn btn-outline btn-sm" data-pick="fact">Fact</button></div>
            <div class="mf-feedback" aria-live="polite"></div>
        </div>
        <div class="mf-item" data-answer="myth" data-explain="Malaysia is already feeling the effects. The December 2021 floods alone caused an estimated RM6.1 billion in losses (DOSM, 2022).">
            <strong>"Malaysia is too far from the poles to be affected."</strong>
            <div class="mf-buttons"><button type="button" class="btn btn-outline btn-sm" data-pick="myth">Myth</button><button type="button" class="btn btn-outline btn-sm" data-pick="fact">Fact</button></div>
            <div class="mf-feedback" aria-live="polite"></div>
        </div>
        <div class="mf-item" data-answer="fact" data-explain="Trees store carbon. When forests are cleared or burned, that carbon goes back into the air as CO₂.">
            <strong>"Clearing forests adds more CO₂ to the atmosphere."</strong>
            <div class="mf-buttons"><button type="button" class="btn btn-outline btn-sm" data-pick="myth">Myth</button><button type="button" class="btn btn-outline btn-sm" data-pick="fact">Fact</button></div>
            <div class="mf-feedback" aria-live="polite"></div>
        </div>
    </div>
@elseif ($part === 'corner')
    <h3 style="margin-top:10px">Climate change in Malaysia</h3>
    <div class="facts">
        <div class="fact"><span class="big">RM6.1 bil</span>Estimated losses from the December 2021 floods <span class="cite">(DOSM, 2022)</span></div>
        <div class="fact"><span class="big">2050</span>Malaysia's target for net-zero greenhouse gas emissions <span class="cite">(Bernama, 2024)</span></div>
        <div class="fact"><span class="big">0.8%</span>Malaysia's share of global greenhouse gas emissions <span class="cite">(Bernama, 2024)</span></div>
    </div>
    <p>The <strong>Ministry of Natural Resources and Environmental Sustainability (NRES)</strong> launched the <strong>National Climate Change Policy 2.0</strong>, a framework for Malaysia's move to a low-carbon economy. It also sets the base for a future Climate Change Act (Bernama, 2024).</p>
    <p>Even though Malaysia's share of global emissions is small, we still feel the impacts, such as floods and extreme weather. Everyone has a part to play.</p>
    <p class="mb-0"><strong>Stay informed:</strong> <a href="https://www.met.gov.my" target="_blank" rel="noopener">MetMalaysia (Jabatan Meteorologi Malaysia)</a> issues weather warnings for heavy rain, thunderstorms and hot weather. <a href="https://www.nres.gov.my" target="_blank" rel="noopener">NRES</a> leads Malaysia's climate policy.</p>
@elseif ($part === 'summary')
    <ul>
        <li>Weather is day-to-day; climate is the long-term pattern.</li>
        <li>Greenhouse gases trap heat. Humans have added more of them by burning fossil fuels and clearing forests.</li>
        <li>Malaysia is already affected, for example by severe floods, and aims for net-zero emissions by 2050.</li>
    </ul>
@elseif ($part === 'sources')
    <ul class="sources">
        <li>Bernama. (2024, September 1). National Climate Change Policy 2.0 launched, boosting low-carbon economy transition. <em>The Sun</em>. <a href="https://thesun.my/news/malaysia-news/national-climate-change-policy-20-launched-boosting-low-carbon-economy-transition-nh13059422/" target="_blank" rel="noopener">Link</a></li>
        <li>Department of Statistics Malaysia. (2022). <em>Special report on impact of floods in Malaysia 2021</em>. <a href="https://www.dosm.gov.my/portal-main/release-content/special-report-on-impact-of-floods-in-malaysia-2021" target="_blank" rel="noopener">Link</a></li>
    </ul>
@endif
