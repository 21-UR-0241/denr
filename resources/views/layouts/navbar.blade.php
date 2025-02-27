<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DENR</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/denr.webp') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/msa.css') }}">
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
                    <a href="/admin/dashboard">HOME</a>
                    <a href="/fpa">FPA</a>
                    <a href="/msa">MSA</a>
                    <a href="/rfpa">RFPA</a>
                    <a href="/sa">SA</a>
                    <a href="/tsa">TSA</a> 
                    <a href="/sp">SP</a>
                    <!-- <div class = "sp">
                        <div class = dropdown-sp>
                            <li>
                    <a href="/sp">SP<i class="ri-arrow-down-s-line"></i></a>
                    </li>
                    <p>Special Patent</p>
                    <div class="sp-content">
                            <a href="">Government</a>
                            <a href="">School</a>
                        </div>
                    </div>
                    </div> -->
                </ul>                    
            </div>
            <div class="nav-2">
                
            <div class = "dropdown-accounts">
            <i class="ri-user-3-fill"></i>
            <a href="" class = "account-button">{{ Auth::user()->username }}</a>
            <div class="accounts-content">
    <!-- <a href="/account">Manage Accounts</a> -->
    <!-- Logout Button -->
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
</div>

<!-- Logout Form (hidden) -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
            
            </div>
            
                
            </div>

 

        </div>
       
        @yield('content')  

</div>


</body>
</html>