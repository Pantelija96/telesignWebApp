@extends('layout')

@section('title') Unsaved @endsection

@section('unsaved') active @endsection

@section('pageName') <i class="ph-house me-2"></i> Unsaved projects @endsection

@section('additionalThemeJS')
    <script src="{{asset('/')}}assets/js/vendor/tables/datatables/datatables.min.js"></script>
@endsection

@section('additionalPageJS')
    <script src="{{asset('/')}}assets/js/home2.js"></script>
@endsection

@section('pageTitle')
    Projects - <span class="fw-normal">@if($view == 1) Grid @else List @endif view </span>
@endsection

@section('breadcrumb')
    <a href="{{url('/unsaved/'.$view)}}" class="breadcrumb-item active">Unsaved projects</a>
    <span class="breadcrumb-item active">@if($view == 1) Grid @else List @endif view</span>
@endsection

@section('content')

    <div class="content">

    @if($view == 1)
        <!-- Filter toolbar -->
            <div class="navbar navbar-expand-lg shadow rounded py-1 mb-3">
                <div class="container-fluid">
                    <div class="text-center d-lg-none">
                        <button type="button" class="navbar-toggler dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#navbar-filter">
                            <i class="ph-funnel me-2"></i>
                            Filters
                        </button>
                    </div>

                    <div class="d-flex order-1 order-lg-2 ms-auto">
                                    <span class="navbar-text d-none d-lg-inline-flex align-items-lg-center me-3 ms-lg-auto">
                                        <i class="ph-eye me-2"></i>
                                        View mode:
                                    </span>

                        <ul class="navbar-nav flex-row">
                            <li class="nav-item">
                                <a href="#" class="navbar-nav-link navbar-nav-link-icon active rounded">
                                    <i class="ph-squares-four"></i>
                                </a>
                            </li>

                            <li class="nav-item ms-1">
                                <a href="{{url('/unsaved/2')}}" class="navbar-nav-link navbar-nav-link-icon rounded">
                                    <i class="ph-list"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /filter toolbar -->

            <!-- Task grid -->

            <div class="text-center text-muted content-divider mb-3">
                <span class="p-2">Unsaved projects</span>
            </div>
            @if($allProjects != null && count($allProjects) > 0)
                <div class="row">
                    @foreach($allProjects as $project)
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="d-inline-flex">
                                            <span class="badge bg-primary me-2">Owner</span>
                                            <span class="badge bg-warning me-2">Unsaved</span>
                                            @if(!$project->scored)
                                                <span class="badge bg-danger me-2">Not scored</span>
                                            @endif
                                        </div>

                                        <div class="dropdown ms-auto">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-gear"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{url('/newProject').'/'.$project->id}}" class="dropdown-item"><i class="ph-calendar-check me-2"></i> Check</a>
                                                <p onclick="sureToDelete({{$project->id}})" style="cursor: pointer;" class="dropdown-item"><i class="ph-x me-2"></i> Remove / delete this project</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h6 class="mb-1"><a href="{{url('/newProject').'/'.$project->id}}">{{$project->name}}</a></h6>
                                        <p class="mb-2">{{$project->description}}</p>
                                    </div>

                                    <div class="d-sm-flex align-items-sm-center flex-sm-wrap">
                                        <div class="d-flex flex-wrap">
                                            <div><span class="text-muted"><i class="ph-calendar me-1"></i> {{date('d.m.Y', strtotime($project->created_at))}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h3><i>No unsaved projects!</i></h3>
            @endif

        <!-- /task grid -->

        @elseif($view != 1)
            <div class="navbar navbar-expand-lg shadow rounded py-1 mb-3">
                <div class="container-fluid">
                    <div class="text-center d-lg-none">
                        <h5 class="mb-0">List view</h5>
                    </div>

                    <div class="navbar-collapse collapse order-2 order-lg-1" id="navbar-filter">
                        <span class="navbar-text d-none d-lg-inline-flex align-items-lg=center me-3">
                            <h5 class="mb-0">List view</h5>
                        </span>
                    </div>

                    <div class="d-flex order-1 order-lg-2 ms-auto">
                        <span class="navbar-text d-none d-lg-inline-flex align-items-lg-center me-3 ms-lg-auto">
                            <i class="ph-eye me-2"></i>
                            View mode:
                        </span>

                        <ul class="navbar-nav flex-row">
                            <li class="nav-item">
                                <a href="{{url('/unsaved/1/')}}" class="navbar-nav-link navbar-nav-link-icon rounded">
                                    <i class="ph-squares-four"></i>
                                </a>
                            </li>

                            <li class="nav-item ms-1">
                                <a href="#" class="navbar-nav-link navbar-nav-link-icon active rounded">
                                    <i class="ph-list"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <table class="table datatable-html">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Project name</th>
                        <th>Project description</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allProjects as $project)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="{{url('/newProject').'/'.$project->id}}">{{$project->name}}</a></td>
                            <td>{{$project->description}}</td>
                            <td>
                                <span class="badge bg-primary me-2">Owner</span>
                                <span class="badge bg-warning me-2">Unsaved</span>
                                @if(!$project->scored)
                                    <span class="badge bg-danger me-2">Scored</span>
                                @endif
                            </td>
                            <td><a href="#">{{date('d.m.Y', strtotime($project->created_at))}}</a></td>
                            <td class="text-center">
                                <div class="d-inline-flex">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph-list"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{url('/newProject').'/'.$project->id}}" class="dropdown-item"><i class="ph-calendar-check me-2"></i> Check</a>
                                            <p onclick="sureToDelete({{$project->id}})" style="cursor: pointer;" class="dropdown-item"><i class="ph-x me-2"></i> Remove / delete this project</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>

@endsection
