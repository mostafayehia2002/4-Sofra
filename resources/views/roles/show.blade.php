@extends('layouts.dashboard')
@section('title')
    show
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
                                <li class="breadcrumb-item active" aria-current="page">Permission</li>
                            </ol>
                        </nav>
                        <h2 class="page-header-title">Show Role</h2>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-primary" href="{{route('roles.index')}}">
                            <i class="bi-person-plus-fill me-1"></i>
                            Return Back
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Role Name:</strong>
                        {{ $role->name }}
                    </div>
                    <br>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">

                        @if(!empty($rolePermissions))
                            <ul>
                               <li> <strong>Permissions:</strong>
                                <ol>
                            @foreach($rolePermissions as $v)
                                <li class="label label-success">{{ $v->name }}</li>
                            @endforeach
                                </ol>
                            </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection
