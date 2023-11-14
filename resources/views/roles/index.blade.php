@extends('layouts.dashboard')
@section('title')
    roles
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
                        <h2 class="page-header-title">Roles</h2>
                    </div>

                    <div class="col-auto">
                        <a class="btn btn-primary" href="{{route('roles.create')}}">
                            <i class="bi-person-plus-fill me-1"></i>
                            Add Role
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
            {{-- errors--}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->name }}</td>
                        <td>

                              <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete Role?")']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}


                        </td>
                    </tr>
                @endforeach
            </table>

            {!! $roles->render() !!}


        </div>
@endsection
