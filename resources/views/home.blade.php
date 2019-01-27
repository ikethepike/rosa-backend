@php($date = new DateTime())
@extends('templates.two-pane')
@section('content-pane')
    <header class="stats">
        <div>
            <h4>Attendance</h4>
            <h2>{{ $week ? $week->attendance->count() : 0 }}</h2>
            <p>Attended class this week</p>
        </div>
        <div>
            <h4>Week</h4>
            <h2>{{ $date->format("W") }}</h2>
            <p>
                There are 
                @if($date->format('m') > 6)
                    {{ 16 - (26 - $date->format('W')) }}
                @else 
                    {{ 16 - $date->format('W') }}
                @endif 
                Lessons left
            </p>
        </div>
        <div>
            <h4>Total students</h4>
            <h2>{{ count($students->registered) }}</h2>
            <p>Registered this term</p>
        </div>
        <div>
            <h4>Highscore</h4>
            <h2>{{ $highscore ? $highscore->score : 0 }}</h2>
            <p>Held by {{ $highscore ? $highscore->name : null }}</p>
        </div>
    </header>

    <nav class="toolkit">
        <a @click="toggleEditor(true)">
            <h4>Create a lesson</h4>
            <lesson-icon></lesson-icon> 
        </a>

        <a href="{{ url()->route('lessons') }}">
            <h4>Manage lessons</h4>
            <science-icon></science-icon>
        </a>

        <a href="{{ url()->route('users') }}">
            <h4>Approve users</h4>
            <user-icon></user-icon> 
        </a>
    </nav>
@endsection
