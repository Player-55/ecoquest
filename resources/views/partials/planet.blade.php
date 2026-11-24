{{-- The learner's planet. $stage = 0 (polluted) to 4 (healed). --}}
<svg class="planet stage-{{ $stage }}" viewBox="0 0 320 320" role="img" aria-label="Your planet: stage {{ $stage }} of 4{{ $stage >= 4 ? ', fully healed' : '' }}">
    <defs>
        <clipPath id="globe-{{ $id ?? 'p' }}"><circle cx="160" cy="165" r="130"/></clipPath>
    </defs>
    <circle class="sun-glow" cx="262" cy="52" r="34" fill="#FDE68A"/>
    <circle cx="262" cy="52" r="22" fill="#F59E0B"/>
    <g clip-path="url(#globe-{{ $id ?? 'p' }})">
        <rect class="sky" x="0" y="0" width="320" height="320"/>
        <path class="sea" d="M0 250 Q160 236 320 250 V320 H0z"/>
        <path class="ground" d="M20 236 Q70 170 140 180 Q200 160 250 190 Q295 205 305 248 Q160 262 20 252z"/>
        {{-- factories & smog --}}
        <g class="smog">
            <rect x="196" y="150" width="18" height="40" fill="#475569"/>
            <rect x="220" y="140" width="18" height="50" fill="#475569"/>
            <ellipse cx="205" cy="128" rx="34" ry="16" fill="#64748B"/>
            <ellipse cx="240" cy="112" rx="40" ry="18" fill="#64748B"/>
            <ellipse cx="110" cy="96" rx="70" ry="22" fill="#94A3B8"/>
        </g>
        {{-- trees appear as levels are completed --}}
        <g class="tree t1"><rect x="86" y="182" width="6" height="22" fill="#7C4A21"/><circle cx="89" cy="176" r="16" fill="#15803D"/></g>
        <g class="tree t2"><rect x="128" y="176" width="6" height="24" fill="#7C4A21"/><circle cx="131" cy="168" r="19" fill="#16A34A"/></g>
        <g class="tree t3"><rect x="160" y="180" width="6" height="22" fill="#7C4A21"/><circle cx="163" cy="173" r="15" fill="#15803D"/></g>
        <g class="tree t4"><rect x="58" y="200" width="6" height="22" fill="#7C4A21"/><circle cx="61" cy="194" r="15" fill="#22C55E"/></g>
        <g class="flower fl">
            <circle cx="110" cy="232" r="5" fill="#F472B6"/><circle cx="150" cy="240" r="5" fill="#FACC15"/>
            <circle cx="190" cy="236" r="5" fill="#F472B6"/><circle cx="230" cy="244" r="5" fill="#FACC15"/>
        </g>
    </g>
    <circle cx="160" cy="165" r="130" fill="none" stroke="#14532D" stroke-width="4"/>
</svg>
