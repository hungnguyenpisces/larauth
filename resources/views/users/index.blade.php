@extends('layouts.app')
@section('page-title')
<h4 class="m-0">Users Management</h4>
@endsection
@section('content')


<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Users Management</h2>
            <div class="card-tools">
                @can('user-create')
                <a class="btn btn-success" href="{{ route('users.create') }}"><i class="fas fa-plus-square"></i> Add User</a>
                @endcan
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered">
                <tr class="bg-blue text-center">
                    <th width="50px">No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th width="200px">Action</th>
                </tr>
                @foreach ($users as $key => $user)
                <tr>
                    <td class="text-center">{{ ++$key }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                        @endif
                    </td>
                    <td class="text-center">
                        <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                            <a class="btn btn-sm btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                            @can('user-edit')
                            <a class="btn btn-sm btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                            @endcan
                            @can('user-delete')
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
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection