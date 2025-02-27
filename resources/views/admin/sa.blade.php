@extends('layouts.navbar')
@section('content')


<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<body>
<div class="table-container">
    <div class="table-title">
        <div class="title-left">
        <h2>SURVEY AUTHORITY</h2>
        <button class="addApplicant" onclick="openForm()">ADD APPLICANT</button>
        </div>
        <div class="search-filter">
            <p class="p-filter">Filter: </p>
            <div class="filter">
            <!-- <select name="filter1" id="filter1">

                <option selected disabled hidden style = "color: #a0a5b1;" >Cleared/Old</option>
                <option value="Subsisting">Cleared</option>
                <option value="Patented">Old</option>
                <option value="">All</option>
            </select> -->
            <select name="filter" id="filter">

                <option selected disabled hidden style = "color: #a0a5b1;" >Status</option>
                <option value="On Process">On Process</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="All">All</option>
            </select>
            </div>


            <div class="search-box">
            <i class="material-icons">&#xE8B6;</i>
            <input type="text" id="searchInput" placeholder="Search&hellip;">
            </div>

        </div>
       
    </div>
    <table class="table" id="tables">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Applicant Name</th>
                        <th>Applicant Number</th>
                        <th>Patented/Subsisting</th>
                        <th>Location</th>
                        <th>Survey No.</th>
                        <th>Remarks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sadata as $sa)
                        <tr>
                            <td>{{ $sa->id_sa}}</td>
                            <td>{{ $sa->applicant_name }}</td>
                            <td>{{ $sa->applicant_number }}</td>
                            <td>{{ $sa->on_process_rejected_approve }}</td>
                            <td>{{ $sa->location }}</td>
                            <td>{{ $sa->survey_no }}</td>
                            <td>{{ $sa->remarks }}</td>
                            <td>
                                <div class="actions">
                                    <button class="edit-btn" data-id="{{ $sa->id_sa }}"
                                        data-applicant_name="{{ $sa->applicant_name }}"
                                        data-applicant_number="{{ $sa->applicant_number }}"
                                        data-on_process_rejected_approve="{{ $sa->on_process_rejected_approve }}"
                                        data-location="{{ $sa->location }}" 
                                        data-survey_no="{{ $sa->survey_no }}"
                                        data-remarks="{{ $sa->remarks }}" onclick="openFormEdit(this)">
                                        <i class="material-icons">&#xE254;</i> <!-- Edit Icon -->
                                    </button>

                                    <form action="{{ route('deletesa', ['id_sa' => $sa->id_sa]) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-confirm">
                                            <i class="material-icons">&#xE872;</i>
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
                <form action="{{ route('addsa') }}" class="form-container" method="POST">
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
                        </div>
                        <div class="column">
                            <label for="applicantnumber">Applicant Number</label>
                            <input type="text" placeholder="Enter Applicant number" name="applicantnumber" required><br>
                            <div class="row">
                                <div class="column">
                                    <label for="surveynumber">Survey Number</label>
                                    <input type="text" placeholder="Enter Survey number" name="surveynumber" required><br>
                                </div>
                                <div class="column">
                                    <div style="margin-left: 20px;">
                                        <label for="status">Status</label><br>
                                        <select name="status">
                                            <option>Select</option>
                                            <option value="on process">On Process</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="approved">Approved</option>
                                        </select>
                                    </div><br>

                                </div>
                            </div>
                        </div>
                    </div>
                    <label for="remarks">Remarks</label><br>
                    <!-- <input type="textarea" placeholder="Remarks" name="remarks" required><br>
                        -->
                    <textarea id="comments" name="remarks" rows="4" cols="50" placeholder="Remarks"></textarea><br><br>
                    <input type="submit" class="btn" style="border-radius: 10px;">

                </form>
            </div>


            <!--*edit*-->
            <div class="form-popupEdit" id="myFormEdit">
                <form action="" class="form-containerEdit" id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="titleCloseButton">
                        <h1 style="margin-bottom: 10px;">EDIT APPLICATION</h1><button type="button" class="close-button"
                            onclick="closeFormEdit()"><i class="material-icons">close</i></button>
                    </div>
                    <hr>
                    <div class="row" style="margin-top: 10px;">
                        <div class="column">
                            <label for="applicantname">Applicant Name</label>
                            <input type="text" placeholder="Enter Applicant name (Surname first)" name="applicantname"
                                required><br>

                            <label for="location">Location</label>
                            <input type="text" placeholder='Enter location' name="location" required><br>

                        </div>
                        <div class="column">


                            <label for="applicantnumber">Applicant Number</label>
                            <input type="text" placeholder="Enter Applicant number" name="applicantnumber" required><br>
                            <div class="row">
                                <div class="column">
                                    <label for="surveynumber">Survey Number</label>
                                    <input type="text" placeholder="Enter Survey number" name="surveynumber" required><br>
                                </div>
                                <div class="column">
                                    <div style="margin-left: 20px;">
                                        <label for="status">Status</label><br>
                                        <select name="status">
                                            <option>Select</option>
                                            <option value="on process">On Process</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="approved">Approved</option>
                                        </select>
                                    </div><br>

                                </div>
                            </div>
                        </div>
                    </div>
                    <label for="remarks">Remarks</label><br>
                    <textarea id="comments" name="remarks" rows="4" cols="50" placeholder="Remarks"></textarea><br><br>
                    <input type="submit" class="btn" style="border-radius: 10px;" value="UPDATE APPLICATION">

                    <script>

                        document.querySelector("#filter").addEventListener("change", filterTable);

                        function filterTable() {

                            const selectedOption = document.querySelector("#filter").value;
                            const tableRows = document.querySelectorAll("#tables tr");

                            tableRows.forEach((row, index) => {
                                if (index === 0) return;

                                if (row.children[3].textContent.toLowerCase() === selectedOption.toLowerCase() || selectedOption === "All") {

                                    row.style.display = "";
                                }
                                else {

                                    row.style.display = "none";

                                }
                            });

                        }

                    </script>


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
                            document.getElementById("editForm").action = "{{ route('updatesa', '') }}/" + button.getAttribute("data-id");

                            console.log("Data Attributes:");
                            console.log("Applicant Name:", button.getAttribute("data-applicant_name"));
                            console.log("Applicant Number:", button.getAttribute("data-applicant_number"));
                            console.log("Location:", button.getAttribute("data-location"));
                            console.log("Survey No:", button.getAttribute("data-survey_no"));
                            console.log("Remarks:", button.getAttribute("data-remarks"));
                            console.log("Status:", button.getAttribute("data-on_process_rejected_approve"));

                            document.querySelector("#myFormEdit input[name='applicantname']").value = button.getAttribute("data-applicant_name");
                            document.querySelector("#myFormEdit input[name='applicantnumber']").value = button.getAttribute("data-applicant_number");
                            document.querySelector("#myFormEdit input[name='location']").value = button.getAttribute("data-location");
                            document.querySelector("#myFormEdit input[name='surveynumber']").value = button.getAttribute("data-survey_no");
                            document.querySelector("#myFormEdit textarea[name='remarks']").value = button.getAttribute("data-remarks");

                            let statusDropdown = document.querySelector("#myFormEdit select[name='status']");
                            let statusValue = button.getAttribute("data-on_process_rejected_approve");

                            for (let option of statusDropdown.options) {
                                if (option.value.toLowerCase() === statusValue.toLowerCase()) {
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
                            swal(
                                {
                                    title: "An error ocurred",
                                    text: "{{ Session::get('error') }}",
                                    icon: "{{ asset('assets/images/error.svg') }}",
                                    button: "close"
                                });
                        </script>

                    @elseif(Session::has('success'))
                        <script>
                            swal(,
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