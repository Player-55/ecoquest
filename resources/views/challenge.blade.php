@extends('layouts.app')
@section('title', '7-Day Green Challenge')

@section('content')
<div class="container" style="max-width:820px;padding-top:32px;padding-bottom:48px">
    <span class="eyebrow">Put it into practice</span>
    <h1 style="font-size:2.2rem">7-Day Green Challenge</h1>
    <p class="muted">Try one green habit each day for a week. Print this page or save it as a PDF, and tick off each day.</p>
    <button type="button" class="btn btn-primary no-print" onclick="window.print()">Print / save as PDF</button>
    <div class="card" style="margin-top:20px">
        <div class="table-wrap">
            <table class="data">
                <thead><tr><th scope="col">Day</th><th scope="col">Challenge</th><th scope="col">Done?</th></tr></thead>
                <tbody>
                    @foreach ([
                        'Bring your own water bottle all day',
                        'Walk, cycle, take public transport or carpool to class',
                        'Bring your own container or bag when you buy food',
                        'Switch off the air-con, lights and chargers whenever you leave your room',
                        'Finish your food and avoid any food waste today',
                        'Separate your rubbish: paper, plastic & metal, glass and food waste',
                        'Check the API on MyJAS EQMS and share one green tip with a friend',
                    ] as $i => $task)
                        <tr><td><strong>Day {{ $i + 1 }}</strong></td><td>{{ $task }}</td><td><span style="display:inline-block;width:22px;height:22px;border:2px solid var(--ink);border-radius:4px" aria-hidden="true"></span></td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="small muted" style="margin-top:12px;margin-bottom:0">Name: ______________________ &nbsp; Week starting: ______________</p>
    </div>
</div>
@endsection
