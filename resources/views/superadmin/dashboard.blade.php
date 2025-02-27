<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DENR</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<div class="main">
        <div class="header">
            <div class="nav">
                <img src="{{asset('assets/images/denr.webp') }}" alt="DENR" class="logo">
                <div class="logo-title">
                <h2 class = "title">DENR</h2>
                <h4 class="subtitile">CENRO</h4>
                </div>
                <ul>
                    <a href="">HOME</a>
                    <a href="">FPA</a>
                    <a href="">MSA</a>
                    <a href="">RFPA</a>
                    <a href="">SA</a>
                    <a href="">TSA</a> 
                    <div class = "sp">
                        <div class = dropdown-sp>
                            <li>
                    <a href="">SP<i class="ri-arrow-down-s-line"></i></a>
                    </li>
                    <p>Special Patent</p>
                    <div class="sp-content">
                            <a href="">Government</a>
                            <a href="">School</a>
                        </div>
                    </div>
                    </div>
                </ul>                    
            </div>
            <div class="nav-2">
                
            
            <i class="ri-user-3-fill"></i>
                <a href="{{route('login')}}">ACCOUNT</a>
                
            </div>

   

        </div> --> 
        @extends('layouts.navbarSuperadmin')
        @section('content')
        
        <div class="container">
        <div class="content1">
            <div class = "content1-1">
            <h1 class="c1">
            City Environment and Natural Resources Office Baguio
            </h1>
            
            <h4 class="vision">Vision</h4>
            <p class="p2">A nation enjoying and sustaining its natural resources and a clean and healthy environment.</p>
            <h4 class="mision">Mission</h4>
            <p class="p2">To mobilize our citizenry in protecting, conserving, and managing the environment and natural resources for the present and future generations.</p>
            </div>
            
        </div>
        <div class="content2">
            <img src="{{asset('assets/images/plants2.png') }}" alt="">
        </div>
    </div>


</div>

            @if(Session::has('success'))
            <script>
                swal({
                    title: "Successful",
                    text: "{{ session('success') }}",
                icon: "{{ asset('assets/images/success.svg') }}",
          button: "Proceed"
                })
                </script>
                @endif
</body>
</html>
@endsection