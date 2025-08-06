@extends('admin.layouts.main')
@section('title', 'user')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            </ol>
                        </div>
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
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <!-- card -->
                    <div class="card card-h-100">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">Add User</button>
                        </div>
                        <!-- card body -->
                        <div class="card-body">
                            <div>
                                <!-- sample modal content -->
                                <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">User Register</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('user.create')}}" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="role" class="form-label">Role</label>
                                                        <select class="form-control" id="role" name="role">
                                                            <option value="admin">Admin</option>
                                                            <option value="agent">Agent</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your name">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
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
                                            <th>Role</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <th>{{$user->id}}</th>
                                            <td>{{$user->role}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->email}}</td>
                                             <td>{{$user->created_at}}</td>
                                            <td>
                                                <a href="{{route('user.edit',$user->id)}}" class="btn btn-primary waves-effect waves-light">Edit</a>
                                                <a href="{{route('user.delete',$user->id)}}" class="btn btn-danger waves-effect waves-light">Delete</a>
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