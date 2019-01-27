@extends('templates.default')
@section('content')

<div class="two-pane-view" :class="{ 'editor-active' : editor.active }">
    <nav class="sidebar">
        <header>
            <a @click="homeClick">
                <logo></logo>
            </a>
        </header>

        <template v-if="!editor.active">
            <section class="links">
                <a @click="toggleEditor(true)">
                    <lesson-icon></lesson-icon>
                    <span>Create</span>
                </a>
                <a href="{{ url('lessons') }}">
                    <science-icon></science-icon>
                    <span>Lessons</span>
                </a>
                <a class='{{ isset($hasUserToApprove) && $hasUserToApprove ? 'notification'  : ''}}' href="{{ url()->route('users') }}">
                    <user-icon></user-icon>
                    <span>Users</span>
                </a>
            </section>

            <section class="bottom">
                <a href="{{ url('/logout') }}">Logout</a>
            </section>
        </template>

        <template v-else>
            <ul class="lesson-listing">
                <lesson-tile v-for='lesson in lessons' :key="lesson.id" :lesson="lesson"></lesson-tile>
            </ul>
        </template>
    </nav>
    <main class="content @yield('content-view')" >
        <editor-view v-if="editor.active" :user="{{ auth()->user() }}"></editor-view>
        <div v-else>
            @yield("content-pane")
        </div>
    </main>
</div>
@endsection
