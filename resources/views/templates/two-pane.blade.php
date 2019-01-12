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
            <a href="{{ url()->route('lessons') }}">
                <lesson-icon></lesson-icon>
                <span>Lessons</span>
            </a>
            <a class='{{ isset($hasUserToApprove) && $hasUserToApprove ? 'notification'  : ''}}' href="{{ url()->route('users') }}">
                <user-icon></user-icon>
                <span>Users</span>
            </a>
            <a href="{{ url()->route('keys') }}">
                <key-icon></key-icon>
                <span>API Keys</span>
            </a>
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
