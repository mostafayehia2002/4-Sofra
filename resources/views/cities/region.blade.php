
@extends('layouts.dashboard')
@section('title')
    Region
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
                                                               href="javascript:;">Pages</a></li>
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Cities</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Regions</li>
                            </ol>
                        </nav>
                        <h2 class="page-header-title">Regions</h2>
                    </div>

                    <div class="col-auto">

                        <a class="btn btn-status-danger" href="{{route('showCity')}}">
                            <i class="bi-chevron-left"></i>
                            Return Back
                        </a>
                        <button type="button" class="btn btn-primary click" data-bs-toggle="modal" data-bs-target="#AddRegion" data-id="{{$city->id}}" data-name="{{$city->name}}">
                            <i class="bi bi-plus fs-4"></i> Add Region
                        </button>
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

            <!-- Table -->
            <table class="table table-borderless table-thead-bordered">
                <thead class="thead-light">

                <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="text-center">City Name</th>
                    <th scope="col" class="text-center">Region Name</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>

                </thead>
                <tbody>
                @foreach($city->regions as $region)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    @if($loop->index==0)
                    <td rowspan="3" class="text-center"> <strong>{{$city->name}}</strong></td>
                    @endif
                    <td class="text-center">{{$region->name}}</td>
                    <td class="text-center">
                        <a href="{{route('deleteRegion',$region->id)}}" class="btn btn-danger" onclick=" return confirm('Are You Sure To Delete Region')">
                            <i class="bi bi-trash"></i>
                        </a>
                        <button type="button" class="btn btn-primary click" data-bs-toggle="modal" data-bs-target="#updateRegion" data-id="{{$region->id}}" data-name="{{$region->name}}">
                            <i class="bi bi-pen click" data-id="{{$region->id}}" data-name="{{$region->name}}"></i>
                        </button>


                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <!-- End Table -->



            <!--add Region-->
        <div class="modal fade" id="addRegion" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Regions</h5>
                        <button type="button" class="btn-close click" data-bs-dismiss="modal" aria-label="Close" data-id="{{$city->id}}" data-city_name="{{$city->name}}"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('storeRegion')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-4">
                                    <input type="hidden" name="id" id="Id" value="">
                                    <label for="cityName" class="form-label"> City Name</label>
                                    <input type="text" class="form-control" name="name" id="Name"
                                           placeholder="City Name" value=""  readonly>
                                </div>
                                <div class="mb-4">
                                    <label for="regionName" class="form-label"> Region Name</label>
                                    <input type="text" class="form-control" name="region" id="regionName"
                                           placeholder="Region Name">
                                </div>

                            <div class="modal-footer">
                                <button type="reset" class="btn btn-white" data-bs-dismiss="modal">Reset</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end model-->
            <!--update Region -->
            <div class="modal fade" id="updateRegion" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Update Region</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('updateRegion')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-4">
                                        <input type="hidden" name="id" id="Id" value="">
                                        <label for="Name" class="form-label"> Region Name</label>
                                        <input type="text" class="form-control" name="name" id="Name"
                                               placeholder="Region Name" value="" >
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
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('click')) {
                    e.preventDefault();
                    let id = e.target.getAttribute('data-id');
                    let name = e.target.getAttribute('data-name');
                    document.querySelectorAll('.modal-body #Id').forEach((e)=>{
                     e.value=id;
                    });
                    document.querySelectorAll('.modal-body #Name').forEach((e)=>{
                        e.value=name;
                    });
                }
            });
        </script>
        </div>
@endsection


