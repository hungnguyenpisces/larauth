@extends('layouts.app')

@section('title', ' | List Permissions')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Permission Management</h2>
            <div class="card-tools">
                @role('Super-Admin')
                <button type="button" class="btn btn-success btn-create" data-toggle="modal" data-target="#PermissionModal">
                    Add Permission
                </button>
                @endrole
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table id="permission_table" class="table table-bordered data-table">
                <thead>
                    <tr class="bg-blue">
                        <th width="50px">No</th>
                        <th>Name</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $key => $permission)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <form action="{{ route('permissions.destroy',$permission->id) }}" method="POST">
                                <a class="btn btn-info btn-sm" href="{{ route('permissions.show',$permission->id) }}">Show</a>
                                @role('Super-Admin')
                                <a class="btn btn-primary btn-sm" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                @endrole
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $permissions->links() }}
        </div>
    </div>
    <!-- /.card -->
</div>
<!-- Modal UpadateOrCreate Permission -->

<div class="modal fade" id="PermissionModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="POST" action="" id="permissionForm">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add permission</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_method" id="permission_method" value="POST">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="" required>
                            @error('name')
                            <p class="mt-2 mb-0 error text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="savedata">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection