@extends('layouts.admin')
@section('content')
<div class="col-lg-8"></div>
<div class="col-lg-4">

    <div class="card">
        <div class="card-header">Add New Permission</div>
        <div class="card-body">
            <form action="{{ route('permission.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="permission name" class="form-label">Permission Name:</label>
                    <input type="text" name="permission_name" id="permission" class="form-control" placeholder="Enter Name">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>


</div>
<div class="col-lg-8">
    <div class="card">
        <div class="carb-header">All Role</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Role</th>
                    <th>Permission</th>
                    <th>Action</th>
                </tr>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        @foreach ($role->getPermissionNames() as $name)
                        <span class="py-2 m-1 badge badge-primary">{{ $name }}</span>


                        @endforeach
                    </td>
                    <td><a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>

                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">Add New Role</div>
        <div class="card-body">
            <form action="{{ route('role.manager.post') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="permission name" class="form-label">Role Name:</label>
                    <input type="text" name="role_name" id="permission" class="form-control" placeholder="Enter Name">
                </div>
                <div class="mb-3">
                    <label for="permission " class="form-label">Permission Name:</label>
                    <div class="form-group">
                       @foreach ($permissions  as $permission)
                       <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input type="checkbox" name="permission_id[]" class="form-check-input" value="{{ $permission->name }}" >{{ $permission->name }}
                        </label>
                    </div>

                       @endforeach

                    </div>

                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="card">
        <div class="card-header">Assign Role</div>
        <div class="card-body">
            <form action="{{ route('assign.role') }}" method="post">
                @csrf
                <div class="mb-3">
                    <select name="user_id" id="" class="form-control">
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>

                        @endforeach
                    </select>

                </div>
                <div class="mb-3">
                    <select name="role" id="" class="form-control">
                       @foreach ($roles as $role)
                       <option value="{{ $role->name }}">{{ $role->name }}</option>

                       @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-lg-8">
    <div class="card">
        <div class="carb-header">All Role</div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                     <th>User</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>
                        @forelse ($user->getRoleNames() as $name)
                        <span class="py-2 m-1 badge badge-primary">{{ $name }}</span>
                        @empty
                        <h5><span class="text-danger">Not Assign Role</span></h5>


                        @endforelse
                    </td>
                    <td><a href="{{ route('user.assign.remove',$user->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>

                @endforeach
            </table>
        </div>
    </div>
</div>


@endsection
