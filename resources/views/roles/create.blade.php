@extends('layouts.dashboard')
@section('title')
    create-roles
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
                        <h2 class="page-header-title">Permission</h2>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-primary" href="{{route('roles.index')}}">
                            <i class="bi-chevron-left"></i>
                            Return Back
                        </a>
                    </div>

                </div>
            </div>
            <!-- End Page Header -->
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{$error}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permissions:</strong>
                            <br/>
                            @foreach($permissions as $permission)
                                <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}">
                                <label for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                <br/>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>



        </div>
@endsection
