<?php
use App\Models\Setting;
$settings = Setting::latest()->first();

?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Del Solved</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/98f0cdd253.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
  />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    @yield('other_styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @toastr_css





</head>
<body>
    <div class="container-fluid">
        <!-- First section -->
        <nav class="navbar navbar-dark bg-dark">
          <div class="container">
            <h1>
              @if ($settings->forum_name)
              <a href="/" class="navbar-brand">{{$settings->forum_name}}</a>
              @else
              <a href="/" class="navbar-brand">Dev Forum</a>
              @endif
            </h1>


            {{-- Survey Button --}}
            @auth
            <a class="nav-item nav-link text-white btn btn-outline-success"
            href="/survey">Survey</a>
            @endauth


            <form action="{{route('category.search')}}" method="POST" class="form-inline mr-3 mb-2 mb-sm-0">
              @csrf
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="keyword" placeholder="Search Category" >
                <div class="input-group-append">
                  <button class="btn btn-outline-success" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>

            @guest
            <a class="nav-item nav-link text-white btn btn-dark" href="{{ route('login') }}">Login</a>
            <a class="nav-item nav-link text-white btn btn-dark" href="{{ route('register') }}">Register</a>
            @endguest

            @auth
            @if ((auth()->user()->is_admin))
            <a class="nav-item nav-link text-white btn btn-outline-success" href="/dashboard/home">Admin Panel</a>
            @endif


            {{-- Profil --}}
            <div>
              @if (auth()->user()->image)
              <a href="/home">
                <img width="45" height="45" class="rounded-circle"
                src="{{ asset('/storage/profile/'.auth()->user()->image) }}" alt="profil-photo">
              </a>
              @else
              <a href="/home">
                <img width="45" height="45" class="rounded-circle"
                src="{{ asset('/images/profile.png') }}" alt="profil-photo">
              </a>
              @endif
            </div>



            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
            @endauth

          </div>
        </nav>

        <!-- first section end -->
      </div>
      <div class="container">
        <nav class="breadcrumb">
          <a href="/" class="breadcrumb-item active"> Dashboard</a>
        </nav>

            @yield('content')



    <div class="container-fluid">
        <footer class="small bg-dark text-white">
          <div class="container py-4">
            <ul class="list-inline mb-0 text-center">
              <li class="list-inline-item">
                &copy; 2022 Del Solved
              </li>
              <li class="list-inline-item">All rights reserved</li>
              <li class="list-inline-item">Terms and privacy policy</li>
            </ul>
          </div>
        </footer>
      </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

     <!-- Script Alert Delete  -->
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
      </script>
      <!-- script js sweet alert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>

      <!-- script untuk konfirmasi hapus data dengan sweet alert  -->
      <script>
        $('.alert_notifsurvey').on('click',function(){
            var getLink = $(this).attr('href');
            Swal.fire({
                title: "Are You Sure?",
                text: 'Do you want delete this survey?',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Delete',
                cancelButtonColor: '#D3D3D3',
                cancelButtonText: "Cancel"

            }).then(result => {
                //jika klik ya maka Delete
                if(result.isConfirmed){
                    window.location.href = getLink
                }
            })
            return false;
        });
    </script>

<script>
    $('.alert_notiftopic').on('click',function(){
        var getLink = $(this).attr('href');
        Swal.fire({
            title: "Are You Sure?",
            text: 'Do you want delete this topic?',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Delete',
            cancelButtonColor: '#D3D3D3',
            cancelButtonText: "Cancel"

        }).then(result => {
            //jika klik ya maka Delete
            if(result.isConfirmed){
                window.location.href = getLink
            }
        })
        return false;
    });
</script>

<script>
    $('.alert_notifreply').on('click',function(){
        var getLink = $(this).attr('href');
        Swal.fire({
            title: "Are You Sure?",
            text: 'Do you want delete this reply?',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Delete',
            cancelButtonColor: '#D3D3D3',
            cancelButtonText: "Cancel"

        }).then(result => {
            //jika klik ya maka Delete
            if(result.isConfirmed){
                window.location.href = getLink
            }
        })
        return false;
    });
</script>



</body>

    @jquery
    @toastr_js
    @toastr_render
</html>
