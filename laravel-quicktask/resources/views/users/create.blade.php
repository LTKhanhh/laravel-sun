<x-app-layout>     
    <x-slot name="header">         
        <h2 class="h4 font-weight-bold" style="color: #ffffff;">             
            {{ __('Add New User') }}         
        </h2>     
    </x-slot>      

    @vite(['resources/sass/app.scss'])     
    <div class="content" style="background: inherit;">         
        <div class="container-fluid" style="background-color: transparent;">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">             
                        <div class="card-header card-header-primary">                 
                            <h4 class="card-title">Create User</h4>
                            <p class="card-category">Add a new user to the system</p>             
                        </div>              

                        <div class="card-body">                 
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">First Name *</label>
                                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name')}}" required>
                                            @error('first_name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Last Name *</label>
                                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                                            @error('last_name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Username *</label>
                                            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                                            @error('username')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> -->
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Email Address *</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Phone Number</label>
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Password *</label>
                                            <input type="password" name="password" class="form-control" required>
                                            @error('password')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Confirm Password *</label>
                                            <input type="password" name="password_confirmation" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Location</label>
                                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                            @error('live_at')
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
                                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            @error('role')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Create User
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
</x-app-layout>
