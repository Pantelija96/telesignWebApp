@extends('layout')

@section('title') New project @endsection

@section('tempMenuItem')
    <li class="nav-item">
        <a href="#" class="nav-link active">
            <i class="ph-pencil"></i><span>Edit project</span>
        </a>
    </li>
@endsection

@section('pageName')
    <i class="ph-house me-2"></i> Edit project
@endsection

@section('additionalThemeJS')
    <script src="{{asset('/')}}assets/js/vendor/tables/datatables/datatables.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/notifications/sweet_alert.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/visualization/echarts/echarts.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/maps/echarts/world.js"></script>
    <link href="{{asset('/')}}assets/flags/css/flag-icons.css" id="stylesheet" rel="stylesheet" type="text/css">
@endsection

@section('additionalPageJS')
    <script>
        var projectId = {{$project->id}};
        var countriesData = @json($project->countries);
        var allow = parseInt({{$project->allow}});
        var flag = parseInt({{$project->flag}});
        var block = parseInt({{$project->block}});
        var very_low = parseInt({{$project->very_low}});
        var low = parseInt({{$project->low}});
        var medium_low = parseInt({{$project->medium_low}});
        var medium = parseInt({{$project->medium}});
        var high = parseInt({{$project->high}});
        var very_high = parseInt({{$project->very_high}});
    </script>
    <script src="{{asset('/')}}assets/js/project.js"></script>
@endsection

@section('pageTitle')
    Edit project
@endsection

@section('breadcrumb')
    <a href="{{url('/home/1')}}" class="breadcrumb-item active">Projects</a>
    <span class="breadcrumb-item active">Edit</span>
    <span class="breadcrumb-item active">{{$project->name}}</span>
@endsection

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header d-sm-flex py-sm-0">
                <h6 class="d-flex py-sm-3 mb-0">
                    Data overview
                    <a href="#card_header" class="text-body d-sm-none ms-auto align-self-center" data-card-action="collapse" data-bs-toggle="collapse">
                        <i class="ph-caret-down"></i>
                    </a>
                </h6>

                <div class="collapse d-sm-block ms-sm-auto my-sm-auto" id="card_header">
                    <div class="form-control-feedback form-control-feedback-end mt-3 mt-sm-0">
                        <form action="{{route('uploadRecords')}}" method="POST" class="modal-body row row-cols-lg-auto g-3 align-items-center justify-content-center" enctype='multipart/form-data'>
                            {{csrf_field()}}
                            <div class="col-12">
                                <input type="file" class="form-control wmin-200" data-bs-popup="popover" name="csvFile" id="csvFile" data-bs-trigger="hover" title="Upload CSV, EXCEL file">
                            </div>

                            <input type="hidden" name="projectId" value="{{$project->id}}"/>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                    <i class="ph-upload-simple ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="card-body">

                <div class="card">
                    <div class="card-header border-bottom-0 pb-0 mb-3 d-flex align-items-center">
                        <h6 class="mb-0" id="addEditFormName">Add new record form</h6>
                        <div class="d-inline-flex ms-auto">
                            <a class="text-body" data-card-action="collapse">
                                <i class="ph-caret-down"></i>
                            </a>
                        </div>
                    </div>

                    <div class="collapse show">
                        <div class="card-body">
                            <form action="#">
                                <div class="row mb-3">
                                    <label class="col-lg-2 col-form-label" style="text-align: right;" for="newNumber"><sup>*</sup>Phone #:</label>
                                    <div class="col-lg-2">
                                        <input type="text" id="newNumber" class="form-control" placeholder="+1234567890">
                                    </div>

                                    <label class="col-lg-1 col-form-label" style="text-align: right;"  for="newEmail">Email:</label>
                                    <div class="col-lg-2">
                                        <input type="text" id="newEmail" class="form-control" placeholder="Email">
                                    </div>

                                    <label class="col-lg-2 col-form-label" style="text-align: right;"  for="newIp">IP address:</label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control" id="newIp" placeholder="IP address">
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" id="addToTable" class="btn btn-primary" onclick="addEdit()">
                                        <span id="addButtonText">Add</span>
                                        <i id="addButtonIcon" class="ph-plus-circle ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card p-lg-3">
                    <table class="table datatable-html">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Number</th>
                            <th>Ip address</th>
                            <th>Email</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($project->records) && count($project->records) > 0)
                            @foreach($project->records as $record)
                                <tr id="row{{$record->id}}">
                                    <td id="iteration{{$record->id}}">{{$loop->iteration}} </td>
                                    <td id="number{{$record->id}}">{{$record->number}}</td>
                                    <td id="ip{{$record->id}}">{{$record->ip}}</td>
                                    <td id="email{{$record->id}}">{{$record->email}}</td>
                                    <td class="text-center">
                                        <div class="d-inline-flex">
                                            <div class="dropdown">
                                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                    <i class="ph-list"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item text-primary" onclick="editThisNumber('{{$record->id}}')">
                                                        <i class="ph-pencil-simple me-2"></i>
                                                        Edit
                                                    </a>
                                                    <a href="#" class="dropdown-item text-danger" onclick="deleteThisNumber('{{$record->id}}')">
                                                        <i class="ph-x me-2"></i>
                                                        Remove
                                                    </a>
                                                    <a href="#" class="dropdown-item text-success" onclick="showOneRecordScores('{{$record->id}}')">
                                                        <i class="ph-chart-bar me-2"></i>
                                                        Show stats for this number
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <input type="hidden" id="_id{{$record->id}}" value="{{$record->id}}"/>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>


            </div>

            <div class="card-footer d-sm-flex justify-content-end align-items-sm-center py-sm-2">
                <form method="POST" action="{{route('scoreRecords')}}" id="scoreForm">
                    {{csrf_field()}}
                    <input type="hidden" name="projectId" value="{{$project->id}}">
                    <button type="button" class="btn btn-primary mt-3 mt-sm-0 w-100 w-sm-auto" onclick="checkBeforeSubmit()">
                        <i class="ph-gear-six me-2"></i>
                        RE-SCORE
                    </button>
                </form>
            </div>

        </div>
    </div>

    @if($project->scored)

        <div class="py-2 mb-3">
            <h3 class="mb-0">Scoring results</h3>
        </div>

        <ul class="nav nav-tabs nav-tabs-underline nav-justified mb-lg-2">
            <li class="nav-item"><a href="#" class="nav-link active scoreNavigation" id="allScore" onclick="showAllNumberScores()">All numbers</a></li>
            <li class="nav-item"><a href="#" class="nav-link scoreNavigation" id="oneScore">One number</a></li>
        </ul>

        <div id="allNumberScore" class="scoreNavigationDisplay">
            <div class="row">
                <div id="countriesMap">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Scattering of numbers</h5>
                        </div>

                        <div class="card-body">
                            <div class="map-container map-echarts" id="worldNumberScatter"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Recommendation breakdown</h5>
                        </div>
                        <div class="card-body text-center chart-container">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="recommendationBreakdown"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Risk level breakdown</h5>
                        </div>
                        <div class="card-body text-center chart-container">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="riskLevelBreakdown"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card card-body">
                        <h3 class="fw-semibold mb-1">Countries and score by countries</h3>

                        <hr class="mb-5">

                        @if($project->scored && count($project->countries) > 0)
                            <div class="d-lg-flex">
                                <ul class="nav nav-tabs nav-tabs-vertical nav-tabs-vertical-start wmin-lg-200 mb-3 mb-lg-0" id="allCountries">
                                    @foreach($project->countries as $country)
                                        <li class="nav-item">
                                            <a href="#country{{$loop->iteration}}" class="nav-link p-3 @if($loop->iteration == 1) active @endif" data-bs-toggle="tab" onclick="activeCountryChartsInit({{$loop->iteration}})">
                                                <span class="fi fi-{{strtolower($country->country_iso)}} fis" style="margin-right: 10px;"></span>
                                                {{$country->country_name}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content flex-lg-fill" style="border-top: 1px solid var(--border-color);">
                                    @foreach($project->countries as $country)
                                        <div class="tab-pane fade show @if($loop->iteration == 1) active @endif p-4" id="country{{$loop->iteration}}">
                                            <div class="row">
                                                <div class="card col-lg-12">
                                                    <div class="card-body" id="barChart">

                                                        <div class="chart-container">
                                                            <div class="chart has-fixed-height" id="stackedBar{{$country->country_iso}}"></div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="card col-lg-6">
                                                    <div class="card-header d-flex flex-wrap">
                                                        <h4 class="mb-0">Recommendation breakdown - {{$country->country_name}}</h4>
                                                    </div>

                                                    <div class="card-body" id="recommendation">
                                                        <div class="chart-container">
                                                            <div class="chart has-fixed-height" id="pieRecommendation{{$country->country_iso}}"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card col-lg-6">
                                                    <div class="card-header d-flex flex-wrap">
                                                        <h4 class="mb-0">Risk level breakdown - {{$country->country_name}}</h4>
                                                    </div>

                                                    <div class="card-body" id="riskLevel">
                                                        <div class="chart-container">
                                                            <div class="chart has-fixed-height" id="pieRiskLevel{{$country->country_iso}}"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <h2>There are no countries or project wasn't scored!</h2>
                        @endif



                    </div>
                </div>

            </div>
        </div>

        <div id="oneNumberScore" class="d-none scoreNavigationDisplay">
            <h1>Showing calculations for: <span id="oneNumberNumber"></span></h1>
            <div class="row">

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white border-bottom-0" id="riskLevelTitle">
                            <h6 class="mb-0 text-black">Risk level:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0 oneNumberCapitalize" id="oneNumberRiskLevel"></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white border-bottom-0 " id="recommendationTitle">
                            <h6 class="mb-0 text-black">Recommendation:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0 oneNumberCapitalize" id="oneNumberRecommendation"></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white bg-light border-bottom-0 ">
                            <h6 class="mb-0">Score:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0" id="oneNumberNumberScore"></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white bg-light border-bottom-0 ">
                            <h6 class="mb-0">Phone type:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0 oneNumberCapitalize" id="oneNumberType"></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white bg-light border-bottom-0 ">
                            <h6 class="mb-0">Country:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0" id="oneNumberCountry"></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-header text-white bg-light border-bottom-0 ">
                            <h6 class="mb-0">Carrier name:</h6>
                        </div>

                        <div class="card-body text-center">
                            <h3 class="mb-0" id="oneNumberCarrier"> </h3>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" id="codeMapping">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Code mapping</h5>
                    </div>

                    <table class="table codeMappingDataT">
                        <thead>
                        <tr>
                            <th>Traffic type</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Risk</th>
                            <th>Trust</th>
                            <th>Details</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="row d-flex flex-row-reverse">
            <div class="col-lg-4" style="text-align: right;">
                <a href="{{url('/roi').'/'.$project->id}}" class="btn btn-primary">
                    ROI
                    <i class="ph-currency-circle-dollar ms-2"></i>
                </a>
            </div>
        </div>
    @endif
@endsection
