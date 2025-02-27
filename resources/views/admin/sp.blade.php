@extends('layouts.navbar')
@section('content')


<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<body>
<div class="table-container">
    <div class="table-title">
        <div class="title-left">
        <h2>TOWNSITE SALES APPLICATION</h2>
        <button class="addApplicant" onclick="openForm()">ADD APPLICANT</button>
        </div>
        <div class="search-filter">
            <p class="p-filter">Filter: </p>
            <div class="filter">
            <select name="filter1" id="filter1">

                <option selected disabled hidden style = "color: #a0a5b1;" value = "none1" >Sector</option>
                <option value="Government">Government</option>
                <option value="School">School</option>
                <option value="All">All</option>
            </select>
            <select name="filter" id="filter">
                <option selected disabled hidden style = "color: #a0a5b1;" value = "none" >Patented/Subsisting</option>
                <option value="Subsisting">Subsisting</option>
                <option value="Patented">Patented</option>
                <option value="All">All</option>
            </select>
            </div>


            <div class="search-box">
            <i class="material-icons">&#xE8B6;</i>
            <input type="text" id="searchInput" placeholder="Search&hellip;">
            </div>


        </div>
       
    </div>
    <table class = "table" id = "tables">
        <thead>
            <tr>
                <th>#</th>
                <th>Applicant Name</th>
                <th>Applicant Number</th>
                <th>Reffered Investigator</th>
                <th>Patented/Subsisting</th>
                <th>Sector</th>
                <th>Location</th>
                <th>Survey No.</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($spdata as $sp)
            <tr>
            <td>{{ $sp->id_sp}}</td>
            <td>{{ $sp->applicant_name }}</td>
            <td>{{ $sp->applicant_number }}</td>
            <td>{{ $sp->reffered_investigator }}</td>
            <td>{{ $sp->patented_subsisting }}</td>
            <td>{{ $sp->sector}}</td>
            <td>{{ $sp->location }}</td>
            <td>{{ $sp->survey_no }}</td>
            <td>{{ $sp->remarks }}</td>
            <td>
                <div class="actions">
                    <button class="edit-btn" title = "Edit" data-id="{{ $sp->id_sp }}"
                        data-applicant_name="{{ $sp->applicant_name }}"
                        data-applicant_number="{{ $sp->applicant_number }}"
                        data-reffered_investigator="{{ $sp->reffered_investigator }}"
                        data-patented_subsisting="{{ $sp->patented_subsisting }}"
                        data-sector="{{ $sp->sector }}"
                        data-location="{{ $sp->location }}" 
                        data-survey_no="{{ $sp->survey_no }}"
                        data-remarks="{{ $sp->remarks }}" onclick="openFormEdit(this)">
                        <i class="material-icons">&#xE254;</i> <!-- Edit Icon -->
                    </button>

            <form action="{{ route('deletesp', ['id_sp' => $sp->id_sp]) }}" method="POST"
                    class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-confirm" title="Delete">
                        <i class="material-icons">&#xe149;</i>
                        </button>
            </form>

                                    <!-- <button class="delete" onclick="deleteConfirmation()"><i class="material-icons">&#xE872;</i></button> -->
            </div>
            </td>
            </tr>
           @endforeach
        </tbody>
    </table>

    <div class="form-popup" id="myForm">
                <form action="{{ route('addsp') }}" class="form-container" method="POST">
                    @csrf
                    <div class="titleCloseButton">
                        <h1 style="margin-bottom: 10px;">ADD APPLICATION</h1><button type="button" class="close-button"
                            onclick="closeForm()"><i class="material-icons">close</i></button>
                    </div>
                    <hr>
                    <div class="row" style="margin-top: 10px;">

                        <div class="column">
                            <label for="applicantname">Applicant Name</label>
                            <input type="text" placeholder="Enter Applicant name (Surname first)" name="applicantname"
                                required><br>
                            <label for="location">Location</label>
                            <input type="text" placeholder='Enter location' name="location" required><br>
                 
                            <label for="status">Status</label><br>
                            <select name="status">
                                <option>Select</option>
                                <option value="Subsisting">Subsisting</option>
                                <option value="Patented">Patented</option>
                            </select>
                            </div>

                        <div class="column">
                            <label for="applicantnumber">Applicant Number</label>
                            <input type="text" placeholder="Enter Applicant number" name="applicantnumber" required><br>
                            <div class="row">
                                <!-- <div class="column"> -->
                                    <label for="surveynumber">Survey Number</label>
                                    <input type="text" placeholder="Enter Survey number" name="surveynumber" required><br>

                                    <div class = "row">
                                    <label for="sector">Sector</label><br>
                                    <select name="sector">
                                        <option>Select</option>
                                        <option value="Government">Government</option>
                                        <option value="School">School</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label for="refferedinvestigator">Reffered Investigator</label>
                    <input type="text" placeholder="Enter Reffered Investigator" name="refferedinvestigator" required><br>

                    <label for="remarks">Remarks</label><br>
                    <!-- <input type="textarea" placeholder="Remarks" name="remarks" required><br>
                        -->
                    <textarea id="comments" name="remarks" rows="4" cols="50" placeholder="Remarks"></textarea><br><br>
                    <input type="submit" class="btn" style="border-radius: 10px;">

                </form>
            </div>


            <div class="form-popupEdit" id="myFormEdit">
                            <form action="" class="form-containerEdit" id="editForm" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="titleCloseButton">
                                    <h1 style="margin-bottom: 10px;">EDIT APPLICATION</h1>
                                    <button type="button" class="close-button" onclick="closeFormEdit()">
                                        <i class="material-icons">close</i>
                                    </button>
                                </div>
                                <hr>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="column">
                                        <label for="applicantname">Applicant Name</label>
                                        <input type="text" placeholder="Enter Applicant name (Surname first)" name="applicantname" required><br>
                                        
                                        <label for="location">Location</label>
                                        <input type="text" placeholder='Enter location' name="location" required><br>

                                        <label for="status">Status</label><br>
                                        <select name="status">
                                            <option>Select</option>
                                            <option value="Subsisting">Subsisting</option>
                                            <option value="Patented">Patented</option>
                                        </select>
                                    </div>

                                    <div class="column">
                                        <label for="applicantnumber">Applicant Number</label>
                                        <input type="text" placeholder="Enter Applicant number" name="applicantnumber" required><br>

                                        <label for="surveynumber">Survey Number</label>
                                        <input type="text" placeholder="Enter Survey number" name="surveynumber" required><br>

                                        <label for="sector">Sector</label><br>
                                        <select name="sector">
                                        <option>Select</option>
                                        <option value="Government">Government</option>
                                        <option value="School">School</option>
                                    </select>
                                        </select>
                                    </div>
                                </div>
                                <label for="refferedinvestigator">Reffered Investigator</label>
                                <input type="text" placeholder="Enter Reffered Investigator" name="refferedinvestigator" required><br>

                                <label for="remarks">Remarks</label><br>
                                <textarea id="comments" name="remarks" rows="4" cols="50" placeholder="Remarks"></textarea><br><br>
                                <input type="submit" class="btn" style="border-radius: 10px;" value="UPDATE APPLICATION">
  
    
    

                                <script>
                                        document.querySelector("#filter").addEventListener("change", filterTable);
                                        document.querySelector("#filter1").addEventListener("change", filterTable);

                                        function filterTable() {
                                            const selectedOption1 = document.querySelector("#filter1").value.toLowerCase(); 
                                            const selectedOption = document.querySelector("#filter").value.toLowerCase();   
                                            const tableRows = document.querySelectorAll("#tables tbody tr");

                                            tableRows.forEach((row) => {
                                                const patentedSubsisting = row.children[4].textContent.toLowerCase();  
                                                const sector = row.children[5].textContent.toLowerCase();             
                                                const matchesPatentedSubsisting = (selectedOption === "all" || patentedSubsisting === selectedOption);
                                                const matchesSector = (selectedOption1 === "all" || sector === selectedOption1);
                                                if (matchesPatentedSubsisting && matchesSector) {
                                                    row.style.display = "";
                                                } else {
                                                    row.style.display = "none";
                                                }
                                            });
                                        }


                                    </script>
                    <!-- <script>
                        document.querySelector("#filter").addEventListener("change", filterTable);
                        document.querySelector("#filter1").addEventListener("change", filterTable);

                        function filterTable() {
                            const selectedOption1 = document.querySelector("#filter1").value; 
                            const selectedOption = document.querySelector("#filter").value; 
                            const tableRows = document.querySelectorAll("#tables tr");
+
                            tableRows.forEach((row, index) => {
                                if (index === 0) return; 

                                const patentedSubsisting = row.children[3].textContent.toLowerCase(); 
                                const Sector = row.children[6].textContent.toLowerCase(); 

                                
                                const matchesPatentedSubsisting = (selectedOption === "All" || patentedSubsisting === selectedOption.toLowerCase());
                                const matchesSector = (selectedOption1 === "All" || Sector === selectedOption1.toLowerCase());

                                
                                if (selectedOption1 === "All" && selectedOption === "All") {
                                    row.style.display = ""; 
                                }
                                else if (selectedOption1 === "Government" && selectedOption == "All"){
                                    row.style.display = "";
                                }
                                else if (selectedOption1 === "Government" && selectedOption === "Subsisting" && Sector === "government" && patentedSubsisting === "subsisting") {
                                    row.style.display = ""; 
                                } 
                                else if (selectedOption1 === "Government" && selectedOption === "Patented" && Sector === "government" && patentedSubsisting === "patented") {
                                    row.style.display = "";
                                } 
                                else if (selectedOption1 === "School" && selectedOption === "Subsisting" && Sector === "school" && patentedSubsisting === "subsisting") {
                                    row.style.display = ""; 
                                } 
                                else if (selectedOption1 === "School" && selectedOption === "Patented" && Sector === "school" && patentedSubsisting === "patented") {
                                    row.style.display = "";
                                } 
                                else if (matchesPatentedSubsisting && matchesSector) {
                                    row.style.display = ""; 
                                } 
                                else {
                                    row.style.display = "none"; 
                                }
                            });
                        }

                        </script> -->
                        


                        <script>

                        
                        function openForm() {
                            document.getElementById("myForm").style.display = "block";
                        }

                        function deleteConfirmation() {
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
                                function (isConfirm) {
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

                        function openFormEdit(button) {
                        document.getElementById("myFormEdit").style.display = "block";
                        document.getElementById("editForm").action = "{{ route('updatesp', '') }}/" + button.getAttribute("data-id");

                        document.querySelector("#myFormEdit input[name='applicantname']").value = button.getAttribute("data-applicant_name");
                        document.querySelector("#myFormEdit input[name='applicantnumber']").value = button.getAttribute("data-applicant_number");
                        document.querySelector("#myFormEdit input[name='refferedinvestigator']").value = button.getAttribute("data-reffered_investigator");
                        document.querySelector("#myFormEdit input[name='location']").value = button.getAttribute("data-location");
                        document.querySelector("#myFormEdit input[name='surveynumber']").value = button.getAttribute("data-survey_no");
                        document.querySelector("#myFormEdit textarea[name='remarks']").value = button.getAttribute("data-remarks");

                        let statusDropdown = document.querySelector("#myFormEdit select[name='status']");
                        let statusValue = button.getAttribute("data-patented_subsisting");

                        let sectorDropdown = document.querySelector("#myFormEdit select[name='sector']");
                        let sectorValue = button.getAttribute("data-sector");
                        for (let option of statusDropdown.options) {
                            if (option.value.toLowerCase() === statusValue.toLowerCase()) {
                                option.selected = true;
                                break;
                            }
                        }
                        for (let option of sectorDropdown.options) {
                            if (option.value.toLowerCase() === sectorValue.toLowerCase()) {
                                option.selected = true;
                                break;
                            }
                        }
                    }



                        function closeFormEdit() {
                            document.getElementById("myFormEdit").style.display = "none";
                        }

                        document.addEventListener("DOMContentLoaded", function () {
                            document.querySelectorAll(".delete-confirm").forEach(button => {
                                button.addEventListener("click", function (e) {
                                    e.preventDefault();

                                    let form = this.closest('form');

                                    swal({
                                        title: "Are you sure?",
                                        text: "Record will be moved to archives",
                                        icon: "{{ asset('assets/images/deleteConfirmation.svg') }}",  // Custom image for the icon
                                        buttons: {
                                            cancel: "No, Cancel",
                                            confirm: "Yes, Proceed"
                                        },
                                        dangerMode: true,
                                    }).then((result) => {
                                        if (result) {
                                            console.log('deleting item');
                                            console.log('deleting item')
                                            form.submit();
                                        }

                                    });
                                });
                            });
                        });

                    </script>




                    @if(Session::has('error'))
                        <script>
                            swal(,
                                {
                                    title: "An error ocurred",
                                    text: "{{ Session::get('error') }}",
                                    icon: "{{ asset('assets/images/error.svg') }}",
                                    button: "close"
                                });
                        </script>

                    @elseif(Session::has('success'))
                        <script>
                            swal(
                                {

                                    title: "Success",
                                    text: "{{ Session::get('success') }}",
                                    icon: "{{ asset('assets/images/success.svg') }}",
                                    button: "Proceed"
                                });
                        </script>
                    @endif

                    <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        document.getElementById("searchInput").addEventListener("input", function () {
                            const searchValue = this.value.toLowerCase();
                            const rows = document.querySelectorAll("#tables tbody tr");

                            rows.forEach(row => {
                                const cells = row.querySelectorAll("td");
                                let match = false;
                                cells.forEach(cell => {
                                    if (cell.textContent.toLowerCase().includes(searchValue)) {
                                        match = true;
                                    }
                                });
                                row.style.display = match ? "" : "none";
                            });
                        });
                    });

                </script>

                        @if(Session::has('message'))
                            <script>
                                swal("Error logging in", "{{ Session::get('message') }}", "error");
                            </script>
                        @elseif(Session::has('success'))
                            <script>
                                swal("Application Added", "{{ Session::get('success') }}", "success");
                            </script>
                        @endif



</body>

@endsection