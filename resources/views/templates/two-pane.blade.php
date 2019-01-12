@extends('templates.default')
@section('content')

<div class="two-pane-view">
    <nav class="sidebar">
        <header>
            <a href="{{ url()->route("home") }}">
                <logo></logo>
            </a>
        </header>

        <section class="links">
            <a href="{{ url('home/lessons') }}">
                <lesson-icon></lesson-icon>
                <span>Lessons</span>
            </a>
            <a class='{{ $hasUsersToApprove ? 'notification'  : ''}}' href="{{ url('home/users') }}">
                <user-icon></user-icon>
                <span>Users</span>
            </di>
        </section>

        <section class="bottom">
            <a href="{{ url('/logout') }}">Logout</a>
        </section>
    </nav>
    <main class="content">
        @yield("content-pane")
    </main>
</div>
@endsection
