@extends('layouts.navbarSuperadmin')
@section('content')


<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<body>
<div class="table-container">
    <div class="table-title">
        <div class="title-left">
        <h2>Manage Users</h2>
        <button class="addApplicant" onclick="openForm()">ADD USER</button>
        </div>
        <div class="search-filter">
            <!-- <p class="p-filter">Filter: </p> -->
            <div class="filter">
            
            </div>
            <div class="search-box">
            <i class="material-icons">&#xE8B6;</i>
            <input type="text" placeholder="Search&hellip;">
        </div>
        </div>
       
    </div>
   
    <table class = "table" id = "tables">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <!-- <th>Password</th> -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accountData as $acc)
            <tr>
            <td>{{ $acc->id}}</td>
            <td>{{ $acc->username }}</td>
            <td>{{ $acc->role}}</td>
            <!-- <td>{{$acc->password}}</td> -->
            
            <td> 
                <div class="actions">
                <a href="#" class="edit"><i class="material-icons">&#xE254;</i></a>
                <a href="" class="delete-confirm" data-url="">
    <i class="material-icons">&#xe149;</i>
</a>

                <!-- <button class="delete" onclick="deleteConfirmation()"><i class="material-icons">&#xE872;</i></button> -->
                </div>
                    </td>
            </tr>
           @endforeach
        </tbody>
    </table>


   


<div class="form-popup" id="myForm">
  <form action="{{ route('createAccount') }}" class="form-container" method="POST">
    @csrf
    <h1>ADD ACCOUNT</h1>

    <label for="username">Username</label>
    <input type="text" placeholder="Username" name="username" required><br>

    <label for="password">Password</label>
    <input type="password" placeholder="Password" name="password" required><br>

    <label for="role">Role (Super Admin/Admin)</label>
    <select name="role">
    <option selected disabled>Select Role</option>
    <option value="Superadmin">Super Admin</option>
    <option value="Admin">Admin</option>
    </select><br>


    <input type="submit" class="btn" value = "Create Account">
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function deleteConfirmation(){
    swal({
  title: "Are you sure?",
  text: "But you will still be able to retrieve this file.",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, archive it!",
  cancelButtonText: "No, cancel please!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    swal("Deleted!", "Your imaginary file has been archived.", "success");
  } else {
    swal("Cancelled", "Your imaginary file is safe :)", "error");
  }
});
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-confirm").forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            let deleteUrl = this.getAttribute("data-url");

            swal({
                title: "Are you sure?",
                text: "Record will be moved to archves",
                icon: "warning",
               buttons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });
    });
});
</script>




@if(Session::has('message'))
<script>
    swal("Error logging in", "{{ Session::get('message') }}", "error",
    {
    
    });
</script>

@elseif(Session::has('success'))
<script>
    swal("Application Added", "{{ Session::get('success') }}", "success",
    {
    
    });
</script>
            @endif

     
</body>

@endsection