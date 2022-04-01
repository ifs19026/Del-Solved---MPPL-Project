@extends('layouts.app')

@section('content')

    <h3>EDIT SURVEY</h3>

    <div class="row">
      <form class="mb-3" action="{{ route('store.edit', $survey->id) }}" method="post">

        @csrf

        <p>Judul</p>
          <input name="title" type="text" value="{{ $survey->title }}">

        <br><br>

        <p>Deskripsi</p>
        <input name="body" type="text" value="{{ $survey->body }}">

        <br><br>

        <p>Link Google Form</p>
        <input name="link" type="text" value="{{ $survey->link }}">

        <br><br>

        <button class="btn btn-primary" type="submit">submit</button>

      </form>
    </div>
  </div>
@endsection