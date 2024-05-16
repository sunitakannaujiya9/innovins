<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserManagement;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\StoreUserRoleRequest;
use App\Http\Requests\Admin\UpdateUserRoleRequest;
use Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('user_type', '!=', 1)->latest()->get();
        return view('admin.user_management.list', compact('users'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRoleRequest $request)
        {

            try
            {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->user_type = $request->user_type;
            $user->save();
           
            return response()->json(['success'=> 'User created successfully!']);
        }

        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'User Management');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $userManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user_management)
    {
        if ($user_management)
        {
            $response = [
                'result' => 1,
                'userManagement' => $user_management,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRoleRequest $request, User $user_management)
{
    try {
        $user_management->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type
        ]);

        return response()->json(['success'=> 'User updated successfully!']);
    } catch (\Exception $e) {
        return $this->respondWithAjax($e, 'updating', 'User Management');
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user_management)
    {
        try {
           
            $user_management->delete();
            return response()->json(['success' => 'User deleted successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'deleting', 'User Management');
        }
    }
}
