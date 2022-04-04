@extends('layouts.app')

@section('content')
<style>

    p{
      font-weight: bold;
    }
    .row{

    }
    input{
      width: 1105px;
      /* padding: 5px; */
      border-radius: 5px;
    }
    .linkGoogleForm{
      color: blue;
      text-decoration: underline;
    }

    button{
      padding: 12px 25px;
    }
    .deskripsi{
      height: 90px;
    }
    @media screen and (max-width: 1200px) {
      /* rentang 768 px -> 1200 px */
      input{
        width: 500px;
      }
    }
    </style>

    <h3>EDIT SURVEY</h3>

    <div class="row">
      <form class="mb-3" action="{{ route('store.edit', $survey->id) }}" method="post">

        @csrf

        <p>Judul</p>
          <input name="title" type="text" value="{{ $survey->title }}">

        <br><br>

        <p>Deskripsi</p>
        <input name="body" type="text" class="deskripsi" value="{{ $survey->body }} ">

        <br><br>

        <p>Link Google Form</p>
        <input name="link" type="text" value="{{ $survey->link }}">

        <br><br>

        <button class="btn btn-primary" type="submit">Submit</button>

      </form>
    </div>
  </div>
@endsection
