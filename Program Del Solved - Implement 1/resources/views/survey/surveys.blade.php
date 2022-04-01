@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-8 table-responsive">
                    <h2 style="color:#333333"><b>SURVEY</b></h2>
                </div>
                <div class="text-right col-lg-4 table-responsive">
                    <a href="/survey/showForm/"><i class="fa-solid fa-circle-plus pr-2"></i>Buat Survey</a>
                    <a class="ml-3" href="/survey/self/{{ auth()->id() }}">Survey Anda</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">

                @foreach ($surveys as $survey)

                    <div class="col-lg-12 table-responsive mb-5 p-3" style="border: 1px solid #C4C4C4">
                    <span>Dibuat oleh </span> <a href="/client/user/{{ $survey->user->id}}">{{ $survey->user->name}}</a>
                        <h5><b>{{ $survey->title }}</b></h5>
                        <p>{{ $survey->body }}</p>
                        <p style="margin-top: -10px;"><a href="#">{{ $survey->link }}</a></p>
                        <div class="align">
                            <span> <i class="fa fa-clock-o pr-2" aria-hidden="true"></i>berlaku hingga 20 maret 2022</span>
                            <a class="text-right btn btn-primary p-2 " href="/survey/{{ $survey->id }}">Lihat Selengkapnya<i class="fa-solid fa-arrow-right pl-2"></i></a>
                        </div>

                    </div>

                @endforeach

            </div>
        </div>
    </div>
    </div>
@endsection
