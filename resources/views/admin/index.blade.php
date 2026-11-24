@extends('layouts.app')
@section('title', 'Admin')

@section('content')
<div class="container" style="padding-top:32px;padding-bottom:48px">
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px">
        <div>
            <span class="eyebrow">Admin</span>
            <h1 style="font-size:2.2rem" class="mb-0">Evaluation results</h1>
        </div>
        <a href="{{ route('admin.export') }}" class="btn btn-primary">Download results (CSV)</a>
    </div>

    <div class="grid grid-4" style="margin-top:24px">
        <div class="card stat"><span class="muted small">Students registered</span><span class="num">{{ $stats['students'] }}</span></div>
        <div class="card stat"><span class="muted small">Average pre-test ({{ $stats['pre_count'] }} done)</span><span class="num">{{ $stats['pre_avg'] ?? '–' }}<span class="small muted">/{{ $stats['total'] }}</span></span></div>
        <div class="card stat"><span class="muted small">Average post-test ({{ $stats['post_count'] }} done)</span><span class="num">{{ $stats['post_avg'] ?? '–' }}<span class="small muted">/{{ $stats['total'] }}</span></span></div>
        <div class="card stat"><span class="muted small">Average gain (paired)</span><span class="num">{{ $stats['gain_avg'] !== null ? ($stats['gain_avg'] >= 0 ? '+' : '').$stats['gain_avg'] : '–' }}</span></div>
    </div>

    <div class="grid grid-2" style="margin-top:24px">
        <div class="card">
            <h2 style="font-size:1.3rem">Survey averages (1–5)</h2>
            <p class="small muted">{{ $surveys->count() }} responses</p>
            @foreach ($surveyAverages as $key => $s)
                <div style="margin-bottom:12px">
                    <div class="small" style="display:flex;justify-content:space-between;gap:12px"><span>{{ strtoupper($key) }}. {{ $s['text'] }}</span><strong>{{ $s['avg'] ?? '–' }}</strong></div>
                    <div class="progress-bar" aria-hidden="true"><span style="width: {{ $s['avg'] ? $s['avg'] / 5 * 100 : 0 }}%"></span></div>
                </div>
            @endforeach
        </div>
        <div class="card">
            <h2 style="font-size:1.3rem">Levels completed</h2>
            @foreach ($levelCounts as $n => $l)
                <div style="margin-bottom:12px">
                    <div class="small" style="display:flex;justify-content:space-between;gap:12px"><span>Level {{ $n }}: {{ $l['title'] }}</span><strong>{{ $l['count'] }} / {{ $stats['students'] }}</strong></div>
                    <div class="progress-bar" aria-hidden="true"><span style="width: {{ $stats['students'] ? $l['count'] / $stats['students'] * 100 : 0 }}%"></span></div>
                </div>
            @endforeach
        </div>
    </div>

    <h2 style="margin-top:32px;font-size:1.3rem">Students</h2>
    <div class="card table-wrap">
        <table class="data">
            <thead><tr><th>Name</th><th>Email</th><th>Eco Points</th><th>Levels</th><th>Pre</th><th>Post</th><th>Gain</th><th>Survey</th></tr></thead>
            <tbody>
                @forelse ($students as $s)
                    @php $pre = $s->testScore('pre'); $post = $s->testScore('post'); @endphp
                    <tr>
                        <td>{{ $s->name }}</td>
                        <td>{{ $s->email }}</td>
                        <td>{{ $s->eco_points }}</td>
                        <td>{{ $s->completedLevels() }}/4</td>
                        <td>{{ $pre?->score ?? '–' }}</td>
                        <td>{{ $post?->score ?? '–' }}</td>
                        <td>{{ $pre && $post ? ($post->score - $pre->score >= 0 ? '+' : '').($post->score - $pre->score) : '–' }}</td>
                        <td>{{ $s->survey ? 'Yes' : 'No' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="muted">No students yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 style="margin-top:32px;font-size:1.3rem">Comments</h2>
    <div class="card">
        @forelse ($surveys->whereNotNull('comment') as $sv)
            <p><strong>{{ $sv->user->name }}:</strong> {{ $sv->comment }}</p>
        @empty
            <p class="muted mb-0">No comments yet.</p>
        @endforelse
    </div>
</div>
@endsection
