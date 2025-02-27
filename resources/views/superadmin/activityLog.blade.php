@extends('layouts.navbarSuperadmin')
@section('content')

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <body>
        <div class="table-container">
            <div class="table-title">
                <div class="title-left">
                    <h2>Activity Log</h2>

                    <input type="date" id="dateInput">
                </div>
                <div class="search-filter">
                    <p class="p-filter">Filter: </p>
                    <div class="filter">
                        <select name="filter" id="filter">
                            <option selected disabled hidden style="color: #a0a5b1;">Application Type</option>
                            <option value="msa">Miscellaneous Sales Application</option>
                            <option value="fpa">Free Patent Application</option>
                            <option value="rfpa">Residential Free Patent Application</option>
                            <option value="sa">Survey Authority</option>
                            <option value="tsa">Townsite Sales Application</option>
                            <option value="sp">Special Patent</option>
                            <option value="All">All</option>
                        </select>
                    </div>

                    <div class="search-box" style="margin-right: 10px;">
                        <i class="material-icons">&#xE8B6;</i>
                        <input type="text" id="searchInput" placeholder="Search&hellip;">
                    </div>

                </div>
            </div>

            <table class="table" id="tables">
                <thead>
                    <tr>
                        <th>Type of Application</th>
                        <th>Applicant's Name</th>
                        <th>Edited By</th>
                        <th>Fields Modified</th>
                        <th>Previous Values</th>
                        <th>Updated Information</th>
                        <th>Modification</th>
                        <th>Date and Time of Update</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($activityLogs as $log)
                        <tr>
                            <td>{{ $log->applicationType }}</td>
                            <td>{{ $log->applicantName }}</td>
                            <td>{{ $log->editor }}</td>
                            <td>{{ $log->fieldEditted }}</td>
                            <td>
                                @if($log->oldValue === null)
                                    <strong>None</strong>
                                @else
                                    @foreach(json_decode($log->oldValue, true) as $key => $value)
                                        <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}<br>
                                     @endforeach
                                @endif
                            </td>
                            <td>
                            @if($log->oldValue === null)
                                    <strong>None</strong>
                            @else
                                @foreach(json_decode($log->newValue, true) as $key => $value)
                                    <strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}<br>
                                @endforeach
                            @endif
                                
                            </td>
                            <td>{{ $log->modificationType }}</td>

                            <td>{{ \Carbon\Carbon::parse($log->datetime)->format('l, F j, Y h:i A') }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            document.querySelector("#filter").addEventListener("change", filterTable);

            function filterTable() {
                const selectedOption = document.querySelector("#filter").value;
                const tableRows = document.querySelectorAll("#tables tr");

                tableRows.forEach((row, index) => {
                    if (index === 0) return;

                    if (row.children[0].textContent.toLowerCase() === selectedOption.toLowerCase() || selectedOption === "All") {
                        row.style.display = "";
                    }
                    else {
                        row.style.display = "none";
                    }
                });
            }
        </script>

    </body>
@endsection