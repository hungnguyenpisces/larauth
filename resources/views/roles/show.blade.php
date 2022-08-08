@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card card-default">
        <div class="card-header">
            <h2 class="card-title">Role: {{ $role->name }}</h2>
            <div class="card-tools">
                <a class="btn btn-success" href="{{ route('roles.index') }}"><i class="fas fa-angle-double-left"></i> Back To Role List</a>
            </div>
        </div>
        <form>
            @csrf
            @method('PUT')
            <div class="card-body">

                <div class="tab-pane" id="settings">
                    <div class="form-horizontal">
                        <div class="form-group">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-md-2 col-form-label">Role name</label>
                            <div class="col-md-10">
                                <input placeholder="Name" class="form-control" name="name" type="text" value="{{ old('name', $role->name)}}" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="inputPermission" class="col-md-2 col-form-label">Permissions</label>
                            <div class="col-md-10">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            @if(!empty($rolePermissions))
                                            @foreach($rolePermissions as $v)
                                            <label class="label label-success">{{ $v->name }},</label>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection