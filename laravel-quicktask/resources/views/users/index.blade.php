<x-app-layout>     
    <x-slot name="header">         
        <h2 class="h4 font-weight-bold" style="color: #ffffff;">             
            {{ __('Users') }}         
        </h2>     
    </x-slot>      

    @vite(['resources/sass/app.scss'])     
    <div class="content" style="background: transparent;">         
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">             
                        <div class="card-header card-header-primary">                 
                            <h4 class="card-title">User Management</h4>
                            <p class="card-category">Complete list of users</p>
                            <div class="card-header-actions">
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-round btn-sm">
                                    <i class="fa fa-plus"></i> Add New User
                                </a>
                            </div>             
                        </div>              

                        <div class="card-body">                 
                            @if($users->isEmpty())                     
                                <div class="alert alert-info text-center">
                                    <span><b>Info!</b> No users found in the system.</span>
                                </div>                 
                            @else                     
                                <div class="table-responsive">                         
                                    <table class="table table-hover">                             
                                        <thead class="text-primary">                                 
                                            <tr>                                     
                                                <th class="text-center">#</th>                                     
                                                <th>Full Name</th>                                     
                                                <th>Username</th>                                     
                                                <th>Email</th>                                     
                                                <th>Phone</th>                                     
                                                <th>Location</th>                                     
                                                <th class="text-center">Role</th>                                     
                                                <th class="text-center">Tasks</th>                                     
                                                <th class="text-right">Actions</th>                                 
                                            </tr>                             
                                        </thead>                             
                                        <tbody>                                 
                                            @foreach ($users as $index => $user)                                     
                                                <tr>                                         
                                                    <td class="text-center">{{ $index + 1 }}</td>                                         
                                                    <td class="text-primary font-weight-bold">{{ $user->fullname }}</td>                                         
                                                    <td>{{ $user->username }}</td>                                         
                                                    <td>{{ $user->email }}</td>                                         
                                                    <td>{{ $user->phone ?? '—' }}</td>                                         
                                                    <td>{{ $user->live_at ?? '—' }}</td>                                         
                                                    <td class="text-center">                                             
                                                        @if($user->role === 'admin')
                                                            <span class="badge badge-success">Admin</span>
                                                        @else
                                                            <span class="badge badge-info">User</span>
                                                        @endif                                         
                                                    </td>                                         
                                                    <td class="text-center">
                                                        <span class="badge badge-pill badge-secondary">{{ $user->tasks->count() }}</span>
                                                    </td>                                         
                                                    <td class="td-actions text-right">                                             
                                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-link btn-sm" data-toggle="tooltip" title="View User">
                                                            <i class="fa fa-eye">Xem</i>
                                                        </a>                                             
                                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-link btn-sm" data-toggle="tooltip" title="Edit User">
                                                            <i class="fa fa-edit">Edit</i>
                                                        </a>                                             
                                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">                                                 
                                                            @csrf                                                 
                                                            @method('DELETE')                                                 
                                                            <button type="submit" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure you want to delete this user?')" data-toggle="tooltip" title="Delete User">
                                                                <i class="fa fa-times">Delete</i>
                                                            </button>                                             
                                                        </form>                                         
                                                    </td>                                     
                                                </tr>                                 
                                            @endforeach                             
                                        </tbody>                         
                                    </table>                     
                                </div>                 
                            @endif             
                        </div>         
                    </div>
                </div>
            </div>
        </div>     
    </div> 
</x-app-layout>
