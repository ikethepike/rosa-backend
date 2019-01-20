@extends('templates.two-pane')
@section('content-pane')
  @if(count($approve) === 0)
    <h3>No users to approve!</h3>
  @else 
    <approval-list :preload="{{ json_encode($approve) }}"></approval-list>
  @endif
@endsection