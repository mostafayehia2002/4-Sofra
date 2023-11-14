@extends('layouts.dashboard')
@section('title')
    Add Admin
@endsection
@section('content')
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="">Management</a></li>
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="">Admins</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Admin</li>
                            </ol>
                        </nav>
                        <h2 class="page-header-title">Add Admin</h2>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-primary" href="{{route('showAdmins')}}">
                            <i class="bi-chevron-left"></i>
                            Return Back
                        </a>
                    </div>
                </div>

            </div>
            <!-- End Page Header -->
            <div class="row">
                <div class="col-lg-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- errors--}}
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{$error}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endforeach
                    @endif
                    <!-- Card -->
                    <form action="{{route('storeAdmin')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <!-- Body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Form -->
                                        <div class="mb-4">
                                            <label for="firstNameLabel" class="form-label">First name</label>
                                            <input type="text" class="form-control" name="firstName" id="firstNameLabel"
                                                   placeholder="first name" value="{{old('firstName')}}">
                                        </div>
                                        <!-- End Form -->
                                    </div>
                                    <!-- End Col -->
                                    <div class="col-sm-6">
                                        <!-- Form -->
                                        <div class="mb-4">
                                            <label for="lastNameLabel" class="form-label">Last name</label>
                                            <input type="text" class="form-control" name="lastName" id="lastNameLabel"
                                                   placeholder="last name" value="{{old('lastName')}}">
                                        </div>
                                        <!-- End Form -->
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                                <!-- Form -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <label for="emailLabel" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="emailLabel"
                                                   placeholder="email@site.com" value="{{old('email')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <label class="form-label" for="exampleFormControlInput3">Password</label>
                                            <input type="password" id="exampleFormControlInput3" class="form-control"
                                                   value="{{old('password')}}" name="password">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <label for="roleLabel" class="form-label">Role</label>
                                            <select class="form-select" id="roleLabel" name="roles">
                                                <option disabled selected>__Select Role__</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role}}">{{$role}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <label for="basicFormFile" class="js-file-attach form-label"
                                                   data-hs-file-attach-options='{
                                         "textTarget": "[for=\"customFile\"]"
                                           }'>Select Photo</label>
                                            <input class="form-control" type="file" id="basicFormFile" accept="image/*"
                                                   name="photo">
                                        </div>
                                    </div>
                                    <!-- End Dropzone -->
                                    <!-- End Form -->

                                    <div class="d-flex justify-content-end gap-3" style="padding-top: 20px">
                                        <button type="reset" class="btn btn-white">Discard</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>

                                <!-- Body -->
                            </div>
                            <!-- End Card -->

                    </form>


                </div>
            </div>
            <!-- End Row -->
        </div>
@endsection
