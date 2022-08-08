@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Roles Management</h2>
            <div class="card-tools">
                <a class="btn btn-success" href="{{ route('roles.create') }}"><i class="fas fa-plus-square"></i> New Role</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered">
                <tr class="bg-blue text-center">
                    <th width="50px">No</th>
                    <th width="250px">Name</th>
                    <th>Permissions</th>
                    <th width="200px">Action</th>
                </tr>
                @foreach ($roles as $key => $role)
                <tr>
                    <td class="text-center">{{ ++$key }}</td>
                    <td class="text-center">{{ $role->name }}</td>
                    <td>
                        @if(!empty($role->permissions))
                        @foreach($role->permissions as $v)
                        <label class="label label-success">{{ $v->name }},</label>
                        @endforeach
                        @endif
                    </td>
                    <td class="text-center">
                        <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                            <a class="btn btn-sm btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                            @can('role-edit')
                            <a class="btn btn-sm btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                            @endcan
                            @can('role-delete')
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>

        </div>
    </div>
    <!-- /.card -->
</div>
@endsection