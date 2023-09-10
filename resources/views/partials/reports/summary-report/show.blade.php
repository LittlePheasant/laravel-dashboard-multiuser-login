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

        <!-- <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> -->
    </head>

    <body>

        <div class="card shadow mb-4">
            <div class="card-header py-auto d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Actual Reports</h6>
                <a href="#" class="btn btn-primary">Print</a>
            </div>

            <div class="card-body">
                <div class="overflow-auto">
                    <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0">
                    <thead>
                    <tr class="table-warning ">
                        <th rowspan="3">Particulars</th>
                        <th rowspan="3">Quarters</th>
                        <th colspan="12">Physical Target by Campus C.Y. <br>2023 </th>
                    </tr>
                    <tr class="table-success ">
                        <th colspan="7">EVSU – MAIN CAMPUS</th>
                        <th rowspan="2">EVSU – Burauen Campus</th>
                        <th rowspan="2">EVSU – Carigara Campus</th>
                        <th rowspan="2">EVSU – Ormoc City Campus</th>
                        <th rowspan="2">EVSU – Tanauan Campus</th>
                        <th rowspan="2">EVSU – Dulag Campus</th>
                    </tr>
                    <tr class="table-secondary ">
                        <th>CAAD</th>
                        <th>CAS</th>
                        <th>COBE</th>
                        <th>COE</th>
                        <th>COED</th>
                        <th>COT</th>
                        <th>GS</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($reports as $particular_id => $particularData)

                        @php $firstParticular = true; @endphp
                        @php $sortedQuarterData = collect($particularData)->sortBy('quarter_id'); @endphp

                        @foreach ($sortedQuarterData as $quarter_id => $quarterData)
                            <tr>
                                @if ($firstParticular)
                                    <td rowspan="{{ count($particularData) }}">{{ $particular_id }}</td>
                                    @php $firstParticular = false; @endphp
                                @endif
                                <td>{{ $quarter_id }}</td>

                                <td>{{ $quarterData[9]['count'] ?? '' }}</td>
                                <td>{{ $quarterData[10]['count'] ?? ''}}</td>
                                <td>{{ $quarterData[11]['count'] ?? ''}}</td>
                                <td>{{ $quarterData[12]['count'] ?? ''}}</td>
                                <td>{{ $quarterData[13]['count'] ?? ''}}</td>
                                <td>{{ $quarterData[14]['count'] ?? ''}}</td>
                                <td>{{ $quarterData[15]['count'] ?? ''}}</td>
                                <td>{{ $quarterData[16]['count'] ?? ''}}</td>
                                <td>{{ $quarterData[17]['count'] ?? ''}}</td>
                                <td>{{ $quarterData[18]['count'] ?? ''}}</td>
                                <td>{{ $quarterData[19]['count'] ?? ''}}</td>
                                <td>{{ $quarterData[20]['count'] ?? ''}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    
                </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Custom scripts for all pages-->
        <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
        
        <!-- Page level plugins -->
        <!-- <script src="{{ asset('admin_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> -->

        <!-- <script>
            $(document).ready( function () {
                $('#summaryTable').DataTable();
            } );
        </script> -->
        
    </body>
</html>


@endsection
