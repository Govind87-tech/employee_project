@extends('admin.layouts.main')
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

        <div class="row">
            <div class="col-xl-12 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <div class="card-header">
                        <h4>Employee Update Form</h4>
                    </div>
                    <!-- card body -->
                    <div class="card-body">


                        <form action="{{route('emp.update',$employe->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="emp_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="emp_name" name="emp_name" value="{{$employe->emp_name}}" placeholder="Enter your name">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$employe->email}}" placeholder="Enter your email">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$employe->address}}" placeholder="Enter your address">
                            </div>
                            <div class="mb-3">
                                <label for="qualification" class="form-label">Latest Qualification</label>
                                <input type="text" class="form-control" id="qualification" name="qualification" value="{{$employe->qualification}}" placeholder="Enter your qualification">
                            </div>
                            <div class="mb-3">
                                <label for="certification" class="form-label">Certification</label>
                                <input type="text" class="form-control" id="certification" name="certification" value="{{$employe->certification}}" placeholder="Enter your certification">
                            </div>
                            <div class="mb-3">
                                <label for="achievement" class="form-label">Achievement</label>
                                <input type="text" class="form-control" id="achievement" name="achievement"value="{{$employe->achievement}}" placeholder="Enter your achievement">
                            </div>
                            <div class="mb-3">
                                <label for="skill" class="form-label">Skill</label>
                                <input type="text" class="form-control" id="skill" name="skill" value="{{$employe->skill}}" placeholder="Enter your skill">
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