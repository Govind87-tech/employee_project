@extends('admin.layouts.main')
@section('title', 'employee')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <!-- <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"></h4> -->

                    <!-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">User</button>

                            </ol>
                        </div> -->

                </div>
            </div>
        </div>
        <!-- end page title -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('error') }}
        </div>
        @endif



        <!-- @php
    echo '<pre>';
    print_r($employees->toArray());
    echo '</pre>';
@endphp -->

        <div class="row">
            <div class="col-xl-12 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">Add Employee</button>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <div>
                            <!-- sample modal content -->
                            <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Emploee Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('emp.store')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="emp_name" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="emp_name" name="emp_name" placeholder="Enter your name">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="qualification" class="form-label">Latest Qualification</label>
                                                    <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Enter your qualification">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="certification" class="form-label">Certification</label>
                                                    <input type="text" class="form-control" id="certification" name="certification" placeholder="Enter your certification">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="achievement" class="form-label">Achievement</label>
                                                    <input type="text" class="form-control" id="achievement" name="achievement" placeholder="Enter your achievement">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="skill" class="form-label">Skill</label>
                                                    <input type="text" class="form-control" id="skill" name="skill" placeholder="Enter your skill">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Image</label>
                                                    <input type="file" class="form-control" id="image" name="image">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="resume" class="form-label">Resume</label>
                                                    <input type="file" class="form-control" id="resume" name="resume" accept=".pdf">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>

                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Qualification</th>
                                        <th>Certification</th>
                                        <th>Achievement</th>
                                        <th>Skill</th>
                                        <th>Image</th>
                                        <th>Resume</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)

                                    <tr>
                                        <th>{{$employee->id}}</th>
                                        <td>{{$employee->emp_username}}</td>
                                        <td>{{$employee->emp_name}}</td>
                                        <td>{{$employee->email}}</td>
                                        <td>{{$employee->address}}</td>
                                        <td>{{$employee->qualification}}</td>
                                        <td>{{$employee->certification}}</td>
                                        <td>{{$employee->achievement}}</td>
                                        <td>{{$employee->skill}}</td>
                                        <td>
                                            <img src="{{asset('public/image/'.$employee->image)}}" alt="image" width="100" style="border-radius: 10px;">
                                        </td>
                                        <td>
                                            <a href="{{ asset('public/resume/' . $employee->resume) }}" target="_blank">Download</a>
                                        </td>
                                        <td>
                                            @if(Auth::check() && Auth::user()->role === 'agent')
                                            <a href="{{ route('emp.edit', $employee->id) }}" class="btn btn-primary my-md-1">Edit</a>
                                            @else
                                            <a href="{{ route('emp.edit', $employee->id) }}" class="btn  btn-primary my-md-1">Edit</a>
                                            <a href="{{ route('emp.delete', $employee->id) }}" class="btn  btn-danger">Delete</a>
                                            @endif
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>



                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
            <!-- card -->
        </div><!-- end col -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection