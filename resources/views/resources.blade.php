@extends('layouts.app')
@section('title', 'Malaysian agencies & resources')

@section('content')
<div class="container" style="padding-top:32px;padding-bottom:48px">
    <span class="eyebrow">Resources</span>
    <h1 style="font-size:2.2rem">Malaysian agencies &amp; resources</h1>
    <p class="muted" style="max-width:720px">These official agencies provide information and services related to climate, the environment and sustainable living in Malaysia. Visit their websites for the latest updates.</p>
    <div class="grid grid-2" style="margin-top:20px">
        @php
            $agencies = [
                ['Kementerian Sumber Asli dan Kelestarian Alam (NRES)', 'Ministry of Natural Resources and Environmental Sustainability. Leads climate change policy, including the National Climate Change Policy 2.0.', 'https://www.nres.gov.my', 'Learn about Malaysia\'s net-zero 2050 goal'],
                ['Jabatan Alam Sekitar (JAS / DOE)', 'Department of Environment. Monitors air and water quality and publishes the Air Pollutant Index (API).', 'https://www.doe.gov.my', 'Check the API with the MyJAS EQMS app'],
                ['Jabatan Meteorologi Malaysia (MetMalaysia)', 'Malaysian Meteorological Department. Issues weather forecasts and warnings.', 'https://www.met.gov.my', 'Check weather warnings before travelling'],
                ['SWCorp', 'Perbadanan Pengurusan Sisa Pepejal dan Pembersihan Awam. Manages solid waste and public cleansing, and runs recycling programmes.', 'https://www.swcorp.gov.my', 'Find recycling information and programmes'],
                ['Jabatan Pertanian Malaysia (DOA)', 'Department of Agriculture. Supports crop farming in Malaysia, including urban agriculture.', 'https://www.doa.gov.my', 'Get started with urban farming'],
                ['Jabatan Pengairan dan Saliran (JPS) – Public InfoBanjir', 'Department of Irrigation and Drainage. Provides rainfall and river level information.', 'https://publicinfobanjir.water.gov.my', 'Check river levels during heavy rain'],
                ['Agensi Pengurusan Bencana Negara (NADMA)', 'National Disaster Management Agency. Coordinates disaster management in Malaysia.', 'https://www.nadma.gov.my', 'Follow official disaster updates'],
            ];
        @endphp
        @foreach ($agencies as [$name, $desc, $url, $use])
            <div class="card">
                <h3>{{ $name }}</h3>
                <p class="muted">{{ $desc }}</p>
                <p class="small"><strong>How you can use it:</strong> {{ $use }}</p>
                <a href="{{ $url }}" target="_blank" rel="noopener" class="btn btn-outline btn-sm">Visit website</a>
            </div>
        @endforeach
    </div>
    <p class="small muted" style="margin-top:20px">Agency names and websites were checked at the time of writing. Ministry names can change, so please refer to official government portals for the latest information.</p>

    <h2 style="margin-top:40px">References</h2>
    <ul class="sources">
        <li>Bernama. (2024, September 1). National Climate Change Policy 2.0 launched, boosting low-carbon economy transition. <em>The Sun</em>. <a href="https://thesun.my/news/malaysia-news/national-climate-change-policy-20-launched-boosting-low-carbon-economy-transition-nh13059422/" target="_blank" rel="noopener">Link</a></li>
        <li>Department of Statistics Malaysia. (2022). <em>Special report on impact of floods in Malaysia 2021</em>. <a href="https://www.dosm.gov.my/portal-main/release-content/special-report-on-impact-of-floods-in-malaysia-2021" target="_blank" rel="noopener">Link</a></li>
        <li>Dzulkifli, S. (2026, April 23). 40% of Malaysia's trash is recyclable. <em>Asia News Network</em>. <a href="https://asianews.network/40-of-malaysias-trash-is-recyclable/" target="_blank" rel="noopener">Link</a></li>
        <li>Fam, C. (2025, July 21). Haze in your area? Here's how to check the Air Pollution Index on your phone. <em>The Star</em>. <a href="https://www.thestar.com.my/tech/tech-news/2025/07/21/haze-in-your-area-here039s-how-to-check-the-air-pollution-index-on-your-phone" target="_blank" rel="noopener">Link</a></li>
        <li>RTM. (2026, January 19). Tanah terbiar dan rezab bandar dimanfaatkan untuk pertanian bandar. <em>Berita RTM</em>. <a href="https://berita.rtm.gov.my/nasional/senarai-berita-nasional/senarai-artikel/tanah-terbiar-dan-rezab-bandar-dimanfaatkan-untuk-pertanian-bandar/" target="_blank" rel="noopener">Link</a></li>
    </ul>
</div>
@endsection
