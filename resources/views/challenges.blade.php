@extends('templates.two-pane')
@section('content-pane')

  <form action="{{ url('/challenges') }}" method="POST">
    <div class="slide-block">
      <label for="image-url">Image url</label>
      <input type="url" name="image" id="image-url" placeholder="http://placekitten.com/1500/400">
    </div>
  
    <div class="slide-block">
      <label for="title">Title</label>
      <input type="text" name="title" id="title" placeholder="Title...">
    </div>

    <div class="slide-block">
      <label for="description" style="display: block;">Description</label>
      <textarea name="description" id="description" placeholder="Description..." style="background: none;"></textarea>
    </div>

    <div class="slide-block">
      <input type="submit" class="button" value="Submit">
    </div>
  </form>



@endsection