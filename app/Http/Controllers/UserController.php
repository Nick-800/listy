<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PhpParser\Node\Expr\Cast\Array_;
use PhpParser\Node\Expr\Cast\String_;
use PSpell\Dictionary;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $users = User::all();
        return response()->json(
            ['data' => $users]
        );
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Display form for creating a new user']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $input = $request->validate([
            'name' => ['string', 'required'],
            'email' => ['string', 'required', 'unique:users,email']
        ]);
    
        // Create a new user with the validated data
        $user = User::create($input);
    
        // Return a response, you might want to return the created user or a success message
        return response()->json(['data' => $user, 'message' => 'User created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        return response()->json(['data' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        return response()->json(['data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        // Validate the incoming request data
        $input = $request->validate([
            'name' => ['string', 'required'],
            'email' => ['string', 'required', 'unique:users,email,' . $id]
        ]);
    
        // Update the user with the validated data
        $user->update($input);
    
        // Return a response, you might want to return the updated user or a success message
        return response()->json(['data' => $user, 'message' => 'User updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete the user
        $user->delete();

        // Return a response, you might want to return a success message
        return response()->json(['message' => 'User deleted successfully']);

        }
}
