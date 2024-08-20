@extends('layout')

@section('title') Main @endsection

@section('homePage') active @endsection

@section('pageName') <i class="ph-house me-2"></i> Home page @endsection

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
    <a href="{{url('/home/'.$view)}}" class="breadcrumb-item active">Projects</a>
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

{{--                    <div class="navbar-collapse collapse order-2 order-lg-1" id="navbar-filter">--}}
{{--                                    <span class="navbar-text d-none d-lg-inline-flex align-items-lg=center me-3">--}}
{{--                                        <i class="ph-funnel me-2"></i>--}}
{{--                                        Filter:--}}
{{--                                    </span>--}}

{{--                        <ul class="navbar-nav flex-wrap mt-2 mt-lg-0">--}}
{{--                                                        <li class="nav-item dropdown">--}}
{{--                                                            <a href="#" class="navbar-nav-link dropdown-toggle rounded" data-bs-toggle="dropdown">--}}
{{--                                                                By date--}}
{{--                                                            </a>--}}

{{--                                                            <div class="dropdown-menu">--}}
{{--                                                                <a href="#" class="dropdown-item">Show all</a>--}}
{{--                                                                <div class="dropdown-divider"></div>--}}
{{--                                                                <a href="#" class="dropdown-item">Last 7 days</a>--}}
{{--                                                                <a href="#" class="dropdown-item">Last 30 days</a>--}}
{{--                                                                <a href="#" class="dropdown-item">Last year</a>--}}
{{--                                                            </div>--}}
{{--                                                        </li>--}}

{{--                            <li class="nav-item dropdown ms-lg-1">--}}
{{--                                <a href="#" class="navbar-nav-link dropdown-toggle rounded" data-bs-toggle="dropdown">--}}
{{--                                    By status--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu">--}}
{{--                                    <a href="{{url('/home2').'/0'}}" class="dropdown-item @if(!$status) active @endif">Show all</a>--}}
{{--                                    <div class="dropdown-divider"></div>--}}
{{--                                    <a href="{{url('/home2').'/0/owned'}}" class="dropdown-item @if($status == "owned") active @endif">Owner</a>--}}
{{--                                    <a href="{{url('/home2').'/0/unsaved'}}" class="dropdown-item @if($status == "unsaved") active @endif">Owner|Unsaved</a>--}}
{{--                                    <a href="{{url('/home2').'/0/readonly'}}" class="dropdown-item @if($status == "readonly") active @endif">Read only</a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

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
                                <a href="{{url('/home/2')}}" class="navbar-nav-link navbar-nav-link-icon rounded">
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
                <span class="p-2">Read only projects</span>
            </div>
            @if(count($readOnlyProjects) > 0)
                <div class="row">
                    @foreach($readOnlyProjects as $project)
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="d-inline-flex">
                                            <span class="badge bg-indigo me-2">Read only</span>
                                        </div>

                                        <div class="dropdown ms-auto">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-gear"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{url('/readOnlyProject').'/'.$project->id}}" class="dropdown-item"><i class="ph-eye me-2"></i> Check as a read only</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h6 class="mb-1"><a href="{{url('/readOnlyProject').'/'.$project->id}}">{{$project->name}}</a></h6>
                                        <p class="mb-2">{{$project->description}}</p>
                                    </div>

                                    <div class="d-sm-flex align-items-sm-center flex-sm-wrap">
                                        <div class="d-flex flex-wrap">
                                            <div><span class="text-muted"><i class="ph-calendar me-1"></i>{{date('d.m.Y', strtotime($project->created_at))}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h3><i>No read-only projects</i></h3>
            @endif

            <div class="text-center text-muted content-divider mb-3">
                <span class="p-2">Owned projects</span>
            </div>
            @if(count($ownedProjects) > 0)
                <div class="row">
                    @foreach($ownedProjects as $project)
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="d-inline-flex">
                                            @if($project->saved)
                                                <span class="badge bg-success me-2">Saved</span>
                                            @else
                                                <span class="badge bg-warning me-2">Unsaved</span>
                                            @endif
                                            <span class="badge bg-primary me-2">Owner</span>
                                        </div>

                                        <div class="dropdown ms-auto">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-gear"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{url('/editProject').'/'.$project->id}}" class="dropdown-item"><i class="ph-pencil-simple me-2"></i> Edit</a>
                                                <a href="{{url('/readOnlyProject').'/'.$project->id}}" class="dropdown-item"><i class="ph-eye me-2"></i> Check as a read only</a>
                                                <p onclick="sureToDelete({{$project->id}})" style="cursor: pointer;" class="dropdown-item"><i class="ph-x me-2"></i> Remove / delete this project</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h6 class="mb-1"><a href="{{url('/readOnlyProject').'/'.$project->id}}">{{$project->name}}</a></h6>
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
                <h3><i>No owned projects!</i></h3>
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
                                <a href="{{url('/home/1/')}}" class="navbar-nav-link navbar-nav-link-icon rounded">
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
                            <td>
                                @if($project->owner == session()->get('user')->id)
                                    <a href="{{url('/editProject').'/'.$project->id}}">{{$project->name}}</a>
                                @else
                                    <a href="{{url('/readOnlyProject').'/'.$project->id}}">{{$project->name}}</a>
                                @endif
                            </td>
                            <td>{{$project->description}}</td>
                            <td>
                                @if($project->owner === session()->get('user')->id)
                                    @if($project->saved)
                                        <span class="badge bg-success me-2">Saved</span>
                                    @else
                                        <span class="badge bg-warning me-2">Unsaved</span>
                                    @endif
                                    <span class="badge bg-primary me-2">Owner</span>
                                @else
                                    <span class="badge bg-indigo me-2">Read only</span>
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
                                            @if($project->owner === session()->get('user')->id)
                                                <a href="{{url('/editProject').'/'.$project->id}}" class="dropdown-item"><i class="ph-pencil-simple me-2"></i> Edit</a>
                                                <a href="{{url('/readOnlyProject').'/'.$project->id}}" class="dropdown-item"><i class="ph-eye me-2"></i> Check as a read only</a>
                                                <p onclick="sureToDelete({{$project->id}})" style="cursor: pointer;" class="dropdown-item"><i class="ph-x me-2"></i> Remove / delete this project</p>
                                            @else
                                                <a href="{{url('/readOnlyProject').'/'.$project->id}}" class="dropdown-item"><i class="ph-eye me-2"></i> Check as a read only</a>
                                            @endif
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
