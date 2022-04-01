@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <div class="col-lg-12 table-responsive">
                        <h4 class="text-white bg-info mb-0 p-4 rounded-top">
                            REQUEST FORUM
                        </h4>
                    </div>

                </div>

                {{-- input title category request --}}
                <div class="mt-3 mb-3">
                    <form action="{{ route('request.forum.store') }}", method="post">
                        @csrf
                        <label class="mb-0" for="">Forum Title</label>
                        <input name="request_forum" class="col-lg-12 table-responsive" type="text">
                        <button class="btn btn-primary mt-3" type="submit">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
