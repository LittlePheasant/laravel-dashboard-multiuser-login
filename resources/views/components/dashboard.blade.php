<!-- resources/views/dashboard.blade.php -->
@extends('layouts.index')

@section('title', 'Dashboard')

@section('contents')

<div class="container-fluid">

    <div class="row">

        <!-- Total Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                User</div>
                            @if($userLength)
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userLength }}</div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('users-lists') }}">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Tasks Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Program
                            </div>
                            @if($programLength)
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $programLength }}</div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('program-list') }}">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Total Accomplishment Report Card -->
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
            
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Accomplishment Report</div>
                            @if($reportLength)
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $reportLength }}</div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('accommplishment-report') }}">
                                <i class="fas fa-list fa-2x text-gray-300"></i>
                            </a>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>


        <!-- Actual Reports Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Actual Accomplishments</div>
                            @if($summaryLength)
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$summaryLength}}</div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('actual-reports') }}">
                                <i class="fas fa-clipboard fa-2x text-gray-300"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection