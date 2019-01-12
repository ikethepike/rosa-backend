@extends('templates.two-pane')
@section('content-pane')
  @if(count($approve) === 0)
    <h3>No users to approve!</h3>
  @else 
    There are users to approve 
  @endif
@endsection