@extends('admin.layouts.main')
@section('title', 'login-details')
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
                        <h4>Login Detail</h4>
                    </div>
                    <!-- card body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Role</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Ip</th>
                                        <th>Browser</th>
                                        <th>Device</th>
                                        <th>Os</th>
                                        <th>Description</th>
                                        <th>Created_at </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($login_details as $login_detail)
                                    <tr>
                                        <th>{{$login_detail->id}}</th>
                                        <td>{{$login_detail->role}}</td>
                                        <td>{{$login_detail->username}}</td>
                                        <td>{{$login_detail->status}}</td>
                                        <td>{{$login_detail->ip}}</td>
                                        <td>{{$login_detail->browser}}</td>
                                        <td>{{$login_detail->device}}</td>
                                        <td>{{$login_detail->os}}</td>
                                        <td>{{$login_detail->description}}</td>
                                        <td>{{$login_detail->created_at}}</td>
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