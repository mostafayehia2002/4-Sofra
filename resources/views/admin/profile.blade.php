@extends('layouts.dashboard')
@section('title')
    Profile
@endsection
@section('content')
        <!-- Profile Cover -->
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
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                        <h2 class="page-header-title">Profile</h2>
                    </div>

                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditProfile">
                            <i class="bi bi-pen"></i>
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
            @if(session('success-update-admin'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success-update-admin') }}
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
            <div class="profile-cover">
                <div class="profile-cover-img-wrapper">
                    <img class="profile-cover-img" src="{{asset('assets/img/1920x400/img1.jpg')}}"
                         alt="Image Description">
                </div>
            </div>
            <!-- End Profile Cover -->

            <!-- Profile Header -->
            <div class="text-center mb-5">
                <!-- Avatar -->
                <div class="avatar avatar-xxl avatar-circle profile-cover-avatar">
                    <img class="avatar-img" src="{{asset('admin_image/profile/'.$admin->photo)}}"
                         alt="Image Description">
                    <span class="avatar-status avatar-status-success"></span>
                </div>
                <!-- End Avatar -->

                <h1 class="page-header-title">{{$admin->name}}
                    @if(!empty($admin->getRoleNames()))
                        @foreach ($admin->getRoleNames() as $v)
                            @if($v=='admin')
                                <i class="bi-patch-check-fill text-primary" data-toggle="tooltip"
                                   data-bs-placement="top" title="Top endorsed"></i>
                            @endif
                        @endforeach
                    @endif
                </h1>

                <!-- List -->
                <ul class="list-inline list-px-2">
                    <li class="list-inline-item">
                        <i class="bi bi-envelope"></i>
                        <span>{{$admin->email}}</span>
                    </li>
                    <li class="list-inline-item">
                        <i class="bi-calendar-week me-1"></i>
                        <span>Joined {{date_format($admin->created_at,'Y:m:d h:i:A')}}</span>
                    </li>
                </ul>
                <!-- End List -->
            </div>
            <!-- End Profile Header -->
        </div>

        <!--Edit Modal -->
        <div class="modal fade" id="EditProfile" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('updateProfile')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{$admin->id}}">
                            <div class="mb-4">
                                <label for="firstNameLabel" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="firstNameLabel"
                                       placeholder="first name" value="{{$admin->name}}">
                            </div>
                            <div class="mb-4">
                                <label for="emailLabel" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="emailLabel"
                                       placeholder="email@site.com" value="{{$admin->email}}">
                            </div>
                                <div class="mb-4">
                                    <label for="passwordLabel" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="passwordLabel">
                                </div>
                            <div class="mb-4">
                                <label for="roleLabel" class="form-label">Role</label>
                                <select class="form-select" id="roleLabel" name="roles">
                                    @foreach($roles as $role)
                                        <option value="{{$role}}" {{$role==$admin->getRoleNames($loop->index)?'selected':''}}>{{$role}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="basicFormFile" class="js-file-attach form-label"
                                       data-hs-file-attach-options='{
                                         "textTarget": "[for=\"customFile\"]"
                                           }'>Select Photo</label>
                                <input class="form-control" type="file" id="adminPhoto" accept="image/*" name="photo">

                            </div>
                                <div class="mb-4">
                                    <img src="{{asset('admin_image/profile/'.$admin->photo)}}" alt="not found" class="photo" height="150px" width="150px">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-white" data-bs-dismiss="modal">Reset</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Modal -->
    <script>
        let inputUpload = document.getElementById("adminPhoto");
        let  image = document.querySelector(".photo");
        if (inputUpload) {
            const imageSrc = image.getAttribute("src");
            inputUpload.onchange = () => {
                let reader = new FileReader();
                if (inputUpload.files[0]) {
                    reader.readAsDataURL(inputUpload.files[0]);
                    // inputUpload.value('imageSrc');
                } else {
                    image.setAttribute("src",imageSrc);
                    image.classList.remove("show");
                }
                reader.onload = () => {
                    image.setAttribute("src", reader.result);
                    image.classList.add("show");
                };
            };
        }
    </script>
@endsection





