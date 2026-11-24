@if ($part === 'learn')
    <h2>What is a carbon footprint?</h2>
    <p>Your <strong>carbon footprint</strong> is the total amount of greenhouse gases released because of the things you do, use and buy. It is usually measured as carbon dioxide (CO₂) or CO₂-equivalent.</p>

    <h3>Where a student's footprint comes from</h3>
    <div class="grid grid-2" style="margin:14px 0">
        <div class="card"><h3>Transport</h3><p class="mb-0 muted">Cars and motorcycles burn petrol. Driving or e-hailing alone every day adds up quickly.</p></div>
        <div class="card"><h3>Electricity</h3><p class="mb-0 muted">Air-conditioners, lights and devices use electricity, and much of Malaysia's electricity still comes from burning fossil fuels such as coal and natural gas.</p></div>
        <div class="card"><h3>Food</h3><p class="mb-0 muted">Farming, transporting and cooking food all produce emissions, and wasted food wastes all of that energy.</p></div>
        <div class="card"><h3>Shopping</h3><p class="mb-0 muted">Every new item has to be made, packaged and delivered. Buying less and reusing more lowers your footprint.</p></div>
    </div>

    <h3>Small changes that make a difference</h3>
    <ul>
        <li>Walk, cycle, take the bus, LRT or MRT, or carpool with friends.</li>
        <li>Set the air-conditioner to around 25°C and switch off lights and devices when you leave.</li>
        <li>Order only what you can finish, and take leftovers home.</li>
        <li>Think twice before buying something new: can you borrow, repair or buy pre-loved?</li>
    </ul>
@elseif ($part === 'corner')
    <h3 style="margin-top:10px">Check the air you breathe: Jabatan Alam Sekitar (JAS)</h3>
    <p>Burning fuel and open burning also pollute the air we breathe. In Malaysia, the <strong>Department of Environment (Jabatan Alam Sekitar, JAS / DOE)</strong> publishes the <strong>Air Pollutant Index (API / IPU)</strong>.</p>
    <div class="facts">
        <div class="fact"><span class="big">Hourly</span>API readings are updated every hour <span class="cite">(Fam, 2025)</span></div>
        <div class="fact"><span class="big">101+</span>API readings of 101 and above are unhealthy <span class="cite">(Fam, 2025)</span></div>
        <div class="fact"><span class="big">200+</span>Readings over 200 are very unhealthy <span class="cite">(Fam, 2025)</span></div>
    </div>
    <p><strong>Try it now:</strong> download the <strong>MyJAS EQMS</strong> app and tap <em>APIMS</em>, or open the <a href="https://eqms.doe.gov.my/APIMS/main" target="_blank" rel="noopener">APIMS dashboard</a>. Find the station nearest to your campus. Is it a good day for outdoor activities?</p>
    <p class="mb-0 small muted">During haze, check the API before exercising outdoors, and follow official health advice.</p>
@elseif ($part === 'summary')
    <ul>
        <li>Your carbon footprint is the total greenhouse gases caused by your activities.</li>
        <li>Transport, electricity, food and shopping are the biggest parts of a student's footprint.</li>
        <li>Use JAS's MyJAS EQMS app or the APIMS dashboard to check the air quality near you.</li>
    </ul>
@elseif ($part === 'sources')
    <ul class="sources">
        <li>Fam, C. (2025, July 21). Haze in your area? Here's how to check the Air Pollution Index on your phone. <em>The Star</em>. <a href="https://www.thestar.com.my/tech/tech-news/2025/07/21/haze-in-your-area-here039s-how-to-check-the-air-pollution-index-on-your-phone" target="_blank" rel="noopener">Link</a></li>
        <li>Department of Environment Malaysia. Air Pollutant Index Management System (APIMS). <a href="https://eqms.doe.gov.my/APIMS/main" target="_blank" rel="noopener">Link</a></li>
    </ul>
@endif
