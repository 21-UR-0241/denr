<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/LoginStyle.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
    <div class = "main">
<div class="row">
        <div class="column">
       <div class ="sides">
        
              
                <div class="heading">
                <img src="{{asset('assets/images/denr.webp') }}" alt="" class = "denr">
                <div style="margin: auto">
            <h1 class="c1">
            City Environment and Natural Resources
         </h1>
         <p style="font-size: 12px">Baguio City, Philippines</p>
</div>
</div>

<form action ="{{ route('authenticate') }}" method="POST" class="form-1">
  @csrf
            <div class="login">
           
            <h4 class="vision" style="text-align: center">Account Login</h4>
            <hr>
            <label for="email">Username</label>
            <input type="text" name="username" id="username" class = "form-control" placeholder="Ex: admin" required><br>
            <label for="password">Password</label>
            <input type = "password" name="password" id="password" class = "form-control" placeholder="Ex: admin123" required>
            <input type="checkbox" onclick="myFunction()" style="text-align: left; margin-right: 10px; "><label style="font-size: 12px; margin-bottom: 40px;">Show Password</label>
<button type = "submit" name = "submit" class="form-control">Login</button>
        
</div>
<!--https://colorhunt.co/palette/3d8d7ab3d8a8fbffe4a3d1c6-->
</div>
        </div>
        <div class="column">
            <img src="{{asset('assets/images/login.svg') }}" alt="" class = "logo">
    
</form>
</div>
    </div>
</div>
@if(Session::has('message'))
<script>
    swal({

                title: "Error logging in",
                text: "{{ Session::get('message') }}",
                icon: "{{ asset('assets/images/wrongCredentials.svg') }}",
          button: "Try again"
       
});
</script>

@elseif(Session::has('success'))
<script>
    swal(
    {
    
      title: "Successfully logged in",
                icon: "{{ asset('assets/images/success.svg') }}",
          button: "Proceed"
    }).then(function() {
window.location = "{{ route('login') }}";
});
</script>
            @endif

<script>
  
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
    </script>
</body>
</html>