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
                <button class="btn btn-primary" data-toggle="modal" data-target="#addReportModal">Add Report</button>
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
                            <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->dates }}</td>
                            <td>{{ $report->title }}</td>
                            <td>{{ $report->type_beneficiary }}</td>
                            <td>{{ $report->count_male }}</td>
                            <td>{{ $report->count_female }}</td>
                            <td>{{ $report->count_male + $report->count_female }}</td>
                            <td>{{ $report->poor_rate }}</td>
                            <td>{{ $report->fair_rate }}</td>
                            <td>{{ $report->satisfactory_rate }}</td>
                            <td>{{ $report->very_satisfactory_rate }}</td>
                            <td>{{ $report->excellent_rate }}</td>
                            <td>{{ $report->duration }}</td>
                            <td>{{ $report->serviceOpt }}</td>
                            <td>{{ $report->partners }}</td>
                            <td>{{ $report->faculty_staff_involve }}</td>
                            <td>{{ $report->role }}</td>
                            <td>{{ $report->cost_fund }}</td>
                            <td>{{ $report->filename }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button class="btn m-1 btn-primary btn-circle"><i class="fas fa-fw fa-lock"></i></button>
                                    <button class="btn m-1 btn-secondary btn-circle"><i class="fas fa-fw fa-lock-open"></i></button>
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


        <div class="modal fade" id="addReportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD REPORT</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        
                        <form action="{{ route('add-report')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- User id -->
                            <input id="user_id" type="hidden" name="user_id">

                            <!-- Program Option -->
                            <div class="col-12">
                                <label for="program_id" class="form-label mb-0">{{ __('Programs') }}</label>
                                <select id="program_id" type="text" class="form-control @error('program_id') is-invalid @enderror" name="program_id" required autocomplete="program_id" autofocus>
                                    <option selected>Choose...</option>
                                    @foreach ($programArray as $programId => $programData)
                                        <option value="{{ $programId }}" data-user-id="{{ $programData['user_id'] }}">{{ $programData['program_name'] }}</option>
                                    @endforeach
                                </select>
                                @error('program_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Inculsive Dates -->
                            <label class="form-label mb-0">Inculsive Dates</label>
                            <div class="col-12 d-flex">
                                
                                <div class="col-md-6">
                                    <label for="startDate" class="form-label mb-0">{{ __('Start Date') }}</label>
                                    <input id="startDate" type="date" class="form-control @error('startDate') is-invalid @enderror" name="startDate" value="{{ old('startDate') }}" required autocomplete="startDate" autofocus>

                                    @error('startDate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="endDate" class="form-label mb-0">{{ __('End Date') }}</label>
                                    <input id="endDate" type="date" class="form-control @error('endDate') is-invalid @enderror" name="endDate" value="{{ old('endDate') }}" required autocomplete="endDate" autofocus>

                                    @error('endDate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="col-12">
                                <label for="title" class="form-label mb-0">{{ __('Title') }}</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus placeholder="Enter your title here.">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Type of Beneficiaries -->
                            <div class="col-12">
                                <label for="type_beneficiary" class="form-label mb-0">{{ __('Type of Beneficiary') }}</label>
                                <input id="type_beneficiary" type="text" class="form-control @error('type_beneficiary') is-invalid @enderror" name="type_beneficiary" value="{{ old('type_beneficiary') }}" required autocomplete="type_beneficiary" autofocus placeholder="Sector/Clientele">

                                @error('type_beneficiary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- No. of Beneficiaries -->
                            <label class="form-label mb-0">No. of Beneficiaries</label>
                            <div class="col-12 d-flex">
                                
                                <!-- Male Count -->
                                <div class="col-md-6">
                                    <label for="count_male" class="form-label mb-0">{{ __('Male') }}</label>
                                    <input id="count_male" type="number" class="form-control @error('count_male') is-invalid @enderror" name="count_male" value="{{ old('count_male') }}" required autocomplete="count_male" autofocus>

                                    @error('count_male')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <!-- Female Count -->
                                <div class="col-md-6">
                                    <label for="count_female" class="form-label mb-0">{{ __('Female') }}</label>
                                    <input id="count_female" type="number" class="form-control @error('count_female') is-invalid @enderror" name="count_female" value="{{ old('count_female') }}" required autocomplete="count_female" autofocus>

                                    @error('count_female')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="error-message" class="text-danger" style="display: none;">
                                Total rates must be equal to total count of beneficiaries.
                            </div>

                            <!-- Quality and Relevance Rating -->
                            <label class="form-label mb-0">Quality and Relevance Rating</label>
                            <div class="col-12 d-flex">
                                
                                <!-- Poor Rate -->
                                <div class="col-md-4">
                                    <label for="poor_rate" class="form-label mb-0">{{ __('Poor') }}</label>
                                    <input id="poor_rate" type="number" class="form-control @error('poor_rate') is-invalid @enderror" name="poor_rate" value="{{ old('poor_rate') }}" required autocomplete="poor_rate" autofocus>

                                    @error('poor_rate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Fair Rate -->
                                <div class="col-md-4">
                                    <label for="fair_rate" class="form-label mb-0">{{ __('Fair') }}</label>
                                    <input id="fair_rate" type="number" class="form-control @error('fair_rate') is-invalid @enderror" name="fair_rate" value="{{ old('fair_rate') }}" required autocomplete="fair_rate" autofocus>

                                    @error('fair_rate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Satisfactory Rate -->
                                <div class="col-md-4">
                                    <label for="satisfactory_rate" class="form-label mb-0">{{ __('Satisfactory') }}</label>
                                    <input id="satisfactory_rate" type="number" class="form-control @error('satisfactory_rate') is-invalid @enderror" name="satisfactory_rate" value="{{ old('satisfactory_rate') }}" required autocomplete="satisfactory_rate" autofocus>

                                    @error('satisfactory_rate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 d-flex">

                                <!-- Very Satisfactory Rate -->
                                <div class="col-md-4">
                                    <label for="verysatisfactory_rate" class="form-label mb-0">{{ __('Very Satisfcatory') }}</label>
                                    <input id="verysatisfactory_rate" type="number" class="form-control @error('verysatisfactory_rate') is-invalid @enderror" name="verysatisfactory_rate" value="{{ old('verysatisfactory_rate') }}" required autocomplete="verysatisfactory_rate" autofocus>

                                    @error('verysatisfactory_rate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Excellent Rate -->
                                <div class="col-md-4">
                                    <label for="excellent_rate" class="form-label mb-0">{{ __('Excellent') }}</label>
                                    <input id="excellent_rate" type="number" class="form-control @error('excellent_rate') is-invalid @enderror" name="excellent_rate" value="{{ old('excellent_rate') }}" required autocomplete="excellent_rate" autofocus>

                                    @error('excellent_rate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Duation and Unit of Measure(Days/Hours) -->
                            <label class="form-label mb-0">Duation and Unit of Measure(Days/Hours)</label>
                            <div class="col-12 d-flex">
                                
                                <!-- Duration -->
                                <div class="col-md-6">
                                    <label for="duration" class="form-label mb-0">{{ __('Duration') }}</label>
                                    <input id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" required autocomplete="duration" autofocus>

                                    @error('duration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Unit of Measure(Days/Hours) -->
                                <div class="col-md-6">
                                    <label for="unitOpt" class="form-label mb-0">{{ __('Unit of Measure') }}</label>
                                    <select id="unitOpt" type="text" class="form-control @error('unitOpt') is-invalid @enderror" name="unitOpt" required autocomplete="unitOpt" autofocus>
                                        @foreach ($units as $unit => $selectedUnit)
                                            <option value="{{$unit}}">{{$selectedUnit}}</option>
                                        @endforeach
                                    </select>
                                    @error('unitOpt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Type of Extension Services Rendered -->
                            <div class="col-12">
                                <label for="serviceOpt" class="form-label mb-0">{{ __('Type of Extension Services Rendered') }}</label>
                                <input id="serviceOpt" type="text" class="form-control @error('serviceOpt') is-invalid @enderror" name="serviceOpt" value="{{ old('serviceOpt') }}" required autocomplete="serviceOpt" autofocus placeholder="Training, Outreach, Consultancy, GAD, etc.">

                                @error('serviceOpt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Partner Agency/Industry/Community -->
                            <div class="col-12">
                                <label for="partners" class="form-label mb-0">{{ __('Partner Agency/Industry/Community') }}</label>
                                <input id="partners" type="text" class="form-control @error('partners') is-invalid @enderror" name="partners" value="{{ old('partners') }}" required autocomplete="partners" autofocus>

                                @error('partners')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Faculty/Staff Involved -->
                            <div class="col-12">
                                <label for="faculty_staff_involve" class="form-label mb-0">{{ __('Faculty/Staff Involved') }}</label>
                                <input id="faculty_staff_involve" type="text" class="form-control @error('faculty_staff_involve') is-invalid @enderror" name="faculty_staff_involve" value="{{ old('faculty_staff_involve') }}" required autocomplete="faculty_staff_involve" autofocus>

                                @error('faculty_staff_involve')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Nature of Participation -->
                            <div class="col-12">
                                <label for="role" class="form-label mb-0">{{ __('Nature of Participation') }}</label>
                                <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" required autocomplete="role" autofocus>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Cost and Funding Source -->
                            <div class="col-12">
                                <label for="cost_fund" class="form-label mb-0">{{ __('Cost and Funding Source') }}</label>
                                <input id="cost_fund" type="number" class="form-control @error('cost_fund') is-invalid @enderror" name="cost_fund" value="{{ old('cost_fund') }}" required autocomplete="cost_fund" autofocus placeholder="Php 0.00">

                                @error('cost_fund')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Attachment -->
                            <div class="col-12">
                                <!-- <label for="file" class="form-label mb-0">Attachment</label>
                                <input type="text" name="file" id='file' class='p-5' 
                                        data-max-file-size="3MB"
                                > -->
                                <label for="filename" class="form-label mb-0">{{ __('Attachment') }}</label>
                                <input id="filename" type="text" class="form-control @error('filename') is-invalid @enderror" name="filename" value="{{ old('filename') }}" required autocomplete="filename" autofocus placeholder="Php 0.00">

                                @error('filename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready( function () {
                
                $('#reportsTable').DataTable();

                // --------------------------------------------------
                // Listen for changes on the program_id select element
                $('#program_id').on('change', function () {
                    // Get the selected option explicitly
                    var selectedOption = $('#program_id option:selected');

                    // Update the user_id input with the data-user-id attribute of the selected option
                    $('#user_id').val(selectedOption.data('user-id'));
                });

                // ---------------------------------------------------
                // Function to calculate the total count of beneficiaries
                function calculateTotalCount() {
                    var totalCount = 0;

                    totalCount += parseInt($("#count_male").val()) || 0;
                    totalCount += parseInt($("#count_female").val()) || 0;

                    return totalCount;
                }

                // Function to calculate the total rates
                function calculateTotalRates() {
                    var totalRates = 0;

                    totalRates += parseInt($("#poor_rate").val()) || 0;
                    totalRates += parseInt($("#fair_rate").val()) || 0;
                    totalRates += parseInt($("#satisfactory_rate").val()) || 0;
                    totalRates += parseInt($("#verysatisfactory_rate").val()) || 0;
                    totalRates += parseInt($("#excellent_rate").val()) || 0;

                    return totalRates;
                }

                // Function to show/hide the error message based on validation
                function validateCountsAndRates() {
                    var totalCount = calculateTotalCount();
                    var totalRates = calculateTotalRates();
                    var myButton = document.getElementById('saveBtn');

                    if (totalCount !== totalRates) {
                        $("#error-message").show();
                        myButton.disabled = true;
                    } else {
                        $("#error-message").hide();
                        myButton.disabled = false;
                    }
                }

                // Call the validation function when input values change
                $("input").on("input", validateCountsAndRates);

                
            } );
        </script>
        
    </body>
</html>


@endsection
