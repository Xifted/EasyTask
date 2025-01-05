<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $adminCheck = Auth::user()->isAdmin();

        if($adminCheck){
            // Handle search
            $search = $request->input('search');
    
            // Handle sort
            $sortOrder = $request->input('sort_order', 'asc');
    
            // Handle pagination
            $perPage = $request->input('per_page', 10);
    
            // Fetch users with filters
            $users = User::with('level')
                ->when($search, function ($query, $search) {
                    return $query->where('name', 'like', "%{$search}%")
                                 ->orWhere('email', 'like', "%{$search}%");
                })
                ->orderBy('id', $sortOrder)
                ->paginate($perPage);

            $userLevels = UserLevel::all(); // For role selection
    
            return view('admin.user-list', compact('users', 'userLevels', 'search', 'sortOrder', 'perPage'));            
        }else{
            return redirect()->back()->with('alert', "You dont have access");
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'level_id' => 'required|exists:user_levels,id',
        ]);

        // Update level user
        $user = User::findOrFail($id);
        $user->level_id = $request->level_id;
        $user->save();

        return redirect()->route('user-list.index')->with('success', 'User role updated successfully.');
    }
}
