@extends('layouts.dashboard')
@section('title')
    Show Admins
@endsection
@section('content')
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                <li class="breadcrumb-item"><a class="breadcrumb-link"
                                                               href="javascript:;">Management</a></li>
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Admins</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Show Admins</li>
                            </ol>
                        </nav>
                        <h2 class="page-header-title">Admins</h2>
                    </div>

                    <div class="col-auto">
                        <a class="btn btn-primary" href="{{route('createAdmin')}}">
                            <i class="bi-person-plus-fill me-1"></i>
                            Add Admin
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-12 col-md">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header-title">Admins</h5>
                            </div>
                        </div>

                        <div class="col-auto">
                            <!-- Filter -->
                            <form>
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend input-group-text">
                                        <i class="bi-search"></i>
                                    </div>
                                    <input id="datatableWithSearchInput" type="search" class="form-control"
                                           placeholder="Search users" aria-label="Search users">
                                </div>
                                <!-- End Search -->
                            </form>
                            <!-- End Filter -->
                        </div>
                    </div>
                </div>
                <!-- End Header -->

                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                           data-hs-datatables-options='{
                   "order": [],
                   "search": "#datatableWithSearchInput",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableWithSearchPagination"
                 }'>
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Create At</th>
                            <th>Time</th>
                            <th>Update At</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    <a class="d-flex align-items-center" href="{{route('editProfile',$admin->id)}}">
                                        <div class="avatar avatar-circle">
                                            <img class="avatar-img"
                                                 src="{{asset('admin_image/profile/'.$admin->photo)}}"
                                                 alt="Image Description">
                                        </div>
                                        <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">{{$admin->name}}
                                        @if(!empty($admin->getRoleNames()))
                                            @foreach ($admin->getRoleNames() as $v)
                                                @if($v=='admin')
                                                    <i class="bi-patch-check-fill text-primary" data-toggle="tooltip"
                                                       data-bs-placement="top" title="Top endorsed"></i>
                                                @endif
                                            @endforeach
                                        @endif
                                    </span>
                                            <span class="d-block fs-5 text-body">{{$admin->email}}</span>
                                        </div>
                                    </a>

                                </td>

                                <td>
                                    Admin
                                </td>
                                <td>
                                    @if($admin->status=='active')
                                        <span class="legend-indicator bg-success"></span>
                                    @else
                                        <span class="legend-indicator bg-danger"></span>
                                    @endif
                                    {{$admin->status}}
                                </td>
                                <td>{{date_format($admin->created_at,'Y:m:d')}}</td>
                                <td>{{date_format($admin->created_at,'h:i:A')}}</td>
                                <td>{{date_format($admin->updated_at,'Y:m:d')}}</td>
                                <td>{{date_format($admin->updated_at,'h:i:A')}}</td>
                                <td>
                                    <a href="{{route('deleteAdmin',$admin->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete Admin')">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    @if(Auth::user()->id !==$admin->id)
                                    <form action="{{route('adminStatus')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$admin->id}}">
                                        <button type="submit" class="btn btn-light" title="change status" style="margin-top:5px">
                                            @if($admin->status=='active')
                                                <span class="legend-indicator bg-danger"></span>
                                            @else
                                                <span class="legend-indicator bg-success"></span>
                                            @endif
                                    </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <nav id="datatableWithSearchPagination" aria-label="Activity pagination"></nav>
                    </div>
                    <!-- End Pagination -->
                </div>
                <!-- End Footer -->
            </div>
        </div>
@endsection
