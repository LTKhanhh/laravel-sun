<x-app-layout>     
    <x-slot name="header">         
        <h2 class="h4 font-weight-bold" style="color: #ffffff;">             
            {{ __('Edit User') }}         
        </h2>     
    </x-slot>      

    @vite(['resources/sass/app.scss'])     
    <div class="content" style="background: inherit;">         
        <div class="container-fluid" style="background-color: transparent;">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">             
                        <div class="card-header card-header-primary">                 
                            <h4 class="card-title">Edit User</h4>
                            <p class="card-category">Update user information</p>             
                        </div>              

                        <div class="card-body">
                            <!-- User Selection Dropdown for Admin -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Select User to Edit</label>
                                        <select id="userSelect" class="form-control" onchange="changeUser(this.value)">
                                            @foreach($users as $u)
                                                <option value="{{ $u->id }}" {{ $u->id == $user->id ? 'selected' : '' }}>
                                                    {{ $u->first_name }} {{ $u->last_name }}  ({{ $u->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-3">
                            
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">First Name *</label>
                                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
                                            @error('first_name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Last Name *</label>
                                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                                            @error('last_name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Email Address *</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Phone Number</label>
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                                            @error('phone')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Location</label>
                                            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                                            @error('address')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Role *</label>
                                            <select name="role" class="form-control" required>
                                                <option value="">Select Role</option>
                                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="manager" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Manager</option>
                                            </select>
                                            @error('role')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Change Password Section -->
                                <hr class="my-4">
                                <!-- <h5 class="text-muted">Change Password (Optional)</h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">New Password</label>
                                            <input type="password" name="password" class="form-control">
                                            <small class="form-text text-muted">Leave blank to keep current password</small>
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                </div> -->

                                <div class="clearfix"></div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">
                                                <i class="fa fa-eye"></i> View User
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Update User
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>         
                    </div>
                </div>
            </div>
        </div>     
    </div>
    
    <script>
        function changeUser(userId) {
            if (userId) {
                window.location.href = "/users/" + userId + "/edit";
            }
        }
    </script>
</x-app-layout>
