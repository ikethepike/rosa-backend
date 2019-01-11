@extends('templates.default')
@section('content')
<div class="content-flow">
  <header>
    <h3>Hi there, {{ $user->firstName }}</h3>
        
  </header>
</div>

@endsection
