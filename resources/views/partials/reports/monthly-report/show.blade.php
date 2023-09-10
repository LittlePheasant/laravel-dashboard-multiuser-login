@extends('layouts.index')

@section('contents')

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Users Table</title>

        <!-- Custom fonts for this template-->
        <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        
        <!-- Custom styles for this template-->
        <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

        <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    </head>

    <body>

        <div class="card shadow mb-4">
            <div class="card-header py-auto d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Accomplishment Report</h6>
                <button class="btn btn-primary">Add Report</button>
            </div>

            <div class="card-body">
                <div class="overflow-auto">

                <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0" id="reportsTable">
                    <thead class="table-success text-gray-800">
                        <tr>
                            <th rowspan="2">#</th>
                            <th rowspan="2">College/Campus</th>
                            <th rowspan="2">Inclusive Dates</th>
                            <th rowspan="2">Title</th>
                            <th rowspan="2">Type of Beneficiaries</th>
                            <th colspan="3">No. of Beneficiaries</th>
                            <th colspan="5">Quality and Relevance Rating</th>
                            <th rowspan="2">Duration</th>
                            <th rowspan="2">Type of Service Rendered</th>
                            <th rowspan="2">Partner Agency/Industry/Community</th>
                            <th rowspan="2">Faculty/Staff Involved</th>
                            <th rowspan="2">Nature of Participation</th>
                            <th rowspan="2">Cost and Funding Source</th>
                            <th rowspan="2">Attachment</th>
                            <th rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Total</th>
                            <th>1 P</th>
                            <th>2 F</th>
                            <th>3 S</th>
                            <th>4 V S</th>
                            <th>5 E</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" >
                        @foreach($reports as $report )

                            <td>{{ $report->id }}</td>
                            <td>{{ $report->avatar }}</td>
                            <td>{{ $report->user->campusname }}</td>
                            <td>{{ $report->name }}</td>
                            <td>{{ $report->reportname }}</td>
                            <td>{{ $report->email }}</td>
                            <td>{{ $report->role }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button class="btn m-1 btn-warning btn-circle" id="editBtn"><i class="fas fa-fw fa-pen"></i></button>
                                    <form action="#" method="POST" type="button" onsubmit="return confirm('Delete?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn m-1 btn-danger btn-circle"><i class="fas fa-fw fa-archive"></i></button>
                                    </form>
                                </div>
                            </td>

                        @endforeach
                    </tbody>
                </table>
            
                    
                </div>
            </div>
        </div>


        <!-- Custom scripts for all pages-->
        <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
        <!-- Page level plugins -->
        <script src="{{ asset('admin_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <script>
            $(document).ready( function () {
                $('#reportsTable').DataTable();
            } );
        </script>
        
    </body>
</html>


@endsection
