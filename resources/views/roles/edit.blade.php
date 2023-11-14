@extends('layouts.dashboard')
@section('title')
    edit
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
                        <h2 class="page-header-title">Edit Role</h2>
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

            <form action="{{route('roles.update',$role->id)}}" method="POST">
                @method('PATCH')
                @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" value="{{$role->name}}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <br/>
                @foreach($permission as $value)
                    <label>{{ Form::checkbox('permission[]', $value->name, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                        {{ $value->name }}</label>
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
