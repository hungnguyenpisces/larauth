@extends('layouts.app')

@section('content')
<!-- general form elements -->
<div class="col-md-12">
    <div class="card card-default">
        <div class="card-header">
            <h2 class="card-title">User info</h2>
            <div class="card-tools">
                <a class="btn btn-success" href="{{ route('users.index') }}"><i class="fa fa-angle-double-left"></i> Back To User List</a>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <label>{{$user->name}}</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <label>{{$user->email}}</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Role:</strong>
                                <label class="badge badge-success">{{$user->getRoleNames()->implode(', ')}}</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Password:</strong>
                                <label>{{$user->password}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Permissions:</strong>
                            <br>
                            @foreach($user->getPermissionsViaRoles() as $permission)
                            <label>{{ $permission->name }}, </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>
@endsection