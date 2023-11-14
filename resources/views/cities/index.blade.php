@extends('layouts.dashboard')
@section('title')
    Cities
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
                                <li class="breadcrumb-item active" aria-current="page">Show Cities</li>
                            </ol>
                        </nav>
                        <h2 class="page-header-title">Show Cities</h2>
                    </div>

                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCity">
                            <i class="bi bi-plus fs-4"></i>
                            Add City
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
            <div class="card">
                <!-- Header -->
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-12 col-md">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header-title">Categories</h5>
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
                            <th>Region</th>
                            <th>Create At</th>
                            <th>Time</th>
                            <th>Update At</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                   @foreach($cities as $city)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$city->name}}</td>
                                <td>
                                    @foreach($city->regions as $region)
                                        <span>{{$region->name}}</span>
                                            @if($loop->index+1 !== count($city->regions))
                                          <span>/</span>
                                            @endif
                                    @endforeach
                                </td>
                                <td>{{date_format($city->created_at,'Y:m:d')}}</td>
                                <td>{{date_format($city->created_at,'h:i:A')}}</td>
                                <td>{{date_format($city->updated_at,'Y:m:d')}}</td>
                                <td>{{date_format($city->updated_at,'h:i:A')}}</td>
                                <td>
                                    <a href="{{route('deleteCity',$city->id)}}" class="btn btn-danger" onclick=" return confirm('Are You Sure To Delete City')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="#updateCity"  class="btn btn-secondary  click" data-bs-toggle="modal" data-id="{{$city->id}}" data-city_name="{{$city->name}}">
                                        <i class="bi bi-pen click"  data-id="{{$city->id}}" data-city_name="{{$city->name}}"></i>
                                    </a>
                                    <a href="{{route('showRegion',$city->id)}}"  class="btn btn-primary">
                                        <i class="bi bi-plus fs-4" ></i>
                                    </a>

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
        <!--Add City -->
        <div class="modal fade" id="AddCity" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add City</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('storeCity')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-4">
                                    <label for="firstNameLabel" class="form-label"> City Name</label>
                                    <input type="text" class="form-control" name="name" id="firstNameLabel"
                                           placeholder="City Name" >
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



        <!--update City -->
        <div class="modal fade" id="updateCity" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update City</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('updateCity')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-4">
                                    <input type="hidden" name="id" id="cityId" value="">
                                    <label for="cityName" class="form-label"> City Name</label>
                                    <input type="text" class="form-control" name="name" id="cityName"
                                           placeholder="City Name" value="" >
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
                    let name = e.target.getAttribute('data-city_name');
                    document.querySelector('.modal-body #cityId').value=id;
                    document.querySelector('.modal-body #cityName').value=name;
                }
            });
        </script
@endsection

