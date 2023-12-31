@extends('layouts.index')

@section('contents')

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Programs Table</title>

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
                <h6 class="m-0 font-weight-bold text-primary">Registered Programs</h6>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addProgramModal">Add Program</a>
            </div>

            <div class="card-body">
                <div class="overflow-auto">
                    <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0" id="programsTable">
                        <thead class="table-primary ">
                            <tr>
                                <th>#</th>
                                <th>College/Campus Name</th>
                                <th>Program Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" >
                            @foreach($programs as $program )
                                <tr>
                                    <td>{{ $program->id }}</td>
                                    <td>{{ $program->user->name }}</td>
                                    <td>{{ $program->program_name }}</td>
                                    <td>{{ $program->description }}</td>

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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal fade" id="addProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Program</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('add-program') }}">
                            @csrf

                            <div class="col-12">
                                <label for="user_id" class="form-label mb-0">{{ __('Campus/College Name') }}</label>
                                <select id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" required autocomplete="user_id" autofocus>
                                    @foreach ($users as $userId => $campusName)
                                        <option value="{{$userId}}">{{$campusName}}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="program_name" class="form-label mb-0">{{ __('Program Name') }}</label>
                                <input id="program_name" type="text" class="form-control @error('program_name') is-invalid @enderror" name="program_name" value="{{ old('program_name') }}" required autocomplete="program_name" autofocus placeholder="Program name">

                                @error('program_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label mb-0">{{ __('Description') }}</label>
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus placeholder="Description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                                <button type="submit" class="btn btn-primary">Register</button>
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
                $('#programsTable').DataTable();
            } );
        </script>
        
    </body>
</html>


@endsection
