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
                <h6 class="m-0 font-weight-bold text-primary">Quarters</h6>
                <a class="btn btn-primary" data-toggle="modal" data-target="#addQuarterModal">Add</a>
            </div>

            <div class="card-body">
                <div class="overflow-auto">
                    <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0" id="quartersTable">
                        <thead class="table-primary ">
                            <tr>
                                <th>#</th>
                                <th>Duration Period</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($quarters as $quarter )

                                @php 
                                    
                                @endphp
                                <tr>
                                    <td>{{ $quarter->id }}</td>
                                    <td>{{ $quarter->duration_period}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn m-1 btn-warning btn-circle"><i class="fas fa-fw fa-pen"></i></a>
                                            <form action="#" method="POST" type="button" onsubmit="return confirm('Delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn m-1 btn-danger btn-circle"><i class="fas fa-fw fa-archive"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal fade" id="addQuarterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Particular</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('add-quarter') }}">
                            @csrf

                            <div class="col-12">
                                <label for="duration_period" class="form-label mb-0">{{ __('Duration') }}</label>
                                <input id="duration_period" type="text" class="form-control @error('duration_period') is-invalid @enderror" name="duration_period" value="{{ old('duration_period') }}" required autocomplete="duration_period" autofocus>

                                @error('duration_period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
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
                $('#quartersTable').DataTable();
            } );

        </script>
        
    </body>
</html>


@endsection
