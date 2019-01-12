@php 

    $date = new DateTime();


@endphp 
@extends('templates.two-pane')
@section('content-pane')
    <header class="stats">
        <div>
            <h4>Attendance</h4>
            <h2>22</h2>
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
            <h2>40</h2>
            <p>Registered this term</p>
        </div>
        <div>
            <h4>Highscore</h4>
            <h2>340</h2>
            <p>Held by Stinky Steve</p>
        </div>
    </header>

    <nav class="toolkit">
        <a href="{{ url('/home/lessons') }}">
            <h4>Create a lesson</h4>
            <lesson-icon></lesson-icon> 
        </a>

        <a href="{{ url('/home/users') }}">
            <h4>Approve users</h4>
            <user-icon></user-icon> 
        </a>

    </nav>

@endsection
