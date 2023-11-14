@extends('layouts.dashboard')
@section('title')
    Categoris
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
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Categories</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Show Categories</li>
                            </ol>
                        </nav>
                        <h2 class="page-header-title">Show Categories</h2>
                    </div>

                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCategory">
                            <i class="bi bi-plus fs-4"></i>
                            Add Category
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
                            <th>Create At</th>
                            <th>Time</th>
                            <th>Update At</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                             @foreach($categories as $category)
                            <tr>
                                <td> {{$loop->index+1}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{date_format($category->created_at,'Y:m:d')}}</td>
                                <td>{{date_format($category->created_at,'h:i:A')}}</td>
                                <td>{{date_format($category->updated_at,'Y:m:d')}}</td>
                                <td>{{date_format($category->updated_at,'h:i:A')}}</td>
                                <td>
                                    <a href="{{route('deleteCategory',$category->id)}}" class="btn btn-danger" onclick=" return confirm('Are You Sure To Delete Category')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="#updateCategory"  class="btn btn-secondary  editCategory" data-bs-toggle="modal" data-id="{{$category->id}}" data-category_name="{{$category->name}}">
                                        <i class="bi bi-pen editCategory" data-id="{{$category->id}}" data-category_name="{{$category->name}}"></i>
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

        <!--Add Category -->
        <div class="modal fade" id="AddCategory" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('storeCategory')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-4">
                                    <label for="firstNameLabel" class="form-label"> Category Name</label>
                                    <input type="text" class="form-control" name="name" id="firstNameLabel"
                                           placeholder="Category Name" >
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


        <!--update Category -->
        <div class="modal fade" id="updateCategory" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('updateCategory')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-4">
                                    <input type="hidden" name="id" id="categoryId" value="">
                                    <label for="categoryName" class="form-label"> Category Name</label>
                                    <input type="text" class="form-control" name="name" id="categoryName"
                                           placeholder="Category Name" value="" >
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
                if (e.target.classList.contains('editCategory')) {
                    e.preventDefault();
                    let id = e.target.getAttribute('data-id');
                    let name = e.target.getAttribute('data-category_name');
                    document.querySelector('.modal-body #categoryId').value = id;
                    document.querySelector('.modal-body #categoryName').value = name;
                }
            });

        </script>
@endsection
