<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();
        // return view('users.index', compact('users'));

        return view('users.index', [
            'users' => User::with('tasks')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
        $userData = $request->safe()->except(['roles']);
        $user = User::create($userData);
        if ($request->has('roles') && is_array($request->roles)) {
            $user->roles()->sync($request->roles);
        }
        return redirect()->route('users.index')
                        ->with('success', 'Người dùng đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // $users = User::all();
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $users = User::all();
        return view('users.edit', compact('user','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $userData = $request->except(['password_confirmation', 'roles', 'avatar']);

        $user->update($userData);

        // Update roles
        if ($request->has('roles') && is_array($request->roles)) {
            $user->roles()->sync($request->roles);
        }

        return redirect()->route('users.show', $user)
                        ->with('success', 'Thông tin người dùng đã được cập nhật!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            // Delete related tasks (or you might want to reassign them)
            $user->tasks()->delete();
            
            // Detach roles
            $user->roles()->detach();
            
            $user->delete();

            return redirect()->route('users.index')
                           ->with('success', 'Người dùng đã được xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Có lỗi xảy ra khi xóa người dùng!');
        }
    }
}
