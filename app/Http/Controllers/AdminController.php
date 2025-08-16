<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = $request->get('order', 'asc');
        $search = $request->get('search');

        // Query
        $query = User::where('role_id', 2);
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $admins = $query->orderBy('name', $order)->paginate(7)->appends([
            $order,
            $search,
        ]);

        return view("back.admin-management.index-admin", compact("admins", "order", "search"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "name"              => "required|string|max:255",
                'username'          => 'required|string|max:255',
                'email'             => 'required|string|email|max:255',
                'password'          => 'required|string|min:8',
                'role_id'           => 'required|exists:roles,id',
            ]);

            User::create([
                'name'      => $request->name,
                'username'  => $request->username,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'role_id'   => $request->role_id,
            ]);

            return redirect()->back()->with('success', 'Admin successfully added.');
        } catch (QueryException $e) {
            Log::error('Failed to add admin:') . $e->getMessage();

            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Failed to add admin: Email already existed.');
            }

            return redirect()->back()->with('error', 'Failed to add admin: due to a database error.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                "name"              => 'required|string|max:255',
                'username'          => 'required|string|max:255',
                'email'             => 'required|string|email|max:255',
                'password'          => 'nullable|string|min:8',
                'role_id'           => 'required|exists:roles,id',
            ]);

            $admin = User::findOrFail($id);

            // Sama seperti di store, ini untuk menambah, tapi dimodifikasi karena 
            // jika kita tidak ingin mengubah password, kita bisa mengosongkannya saja.
            $data = $request->only(['name', 'username', 'email', 'role_id']);
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $admin->update($data);
            return redirect()->back()->with('success', 'Admin successfully updated.');
        } catch (QueryException $e) {
            Log::error('Failed to update admin:') . $e->getMessage();

            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Failed to update admin: Email already existed.');
            }
            return redirect()->back()->with('error', 'Failed to update admin: due to a database error.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::find($id);
        $admin->delete();
        return redirect()->back()->with('deleted', 'Admin deleted successfully');
    }
}
