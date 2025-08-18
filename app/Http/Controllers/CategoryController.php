<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use \Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = $request->get('order', 'asc');
        $search = $request->get('search');

        // Query
        $query = Categories::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $categories = $query->orderBy('name', $order)->paginate(7)->appends([
            $order,
            $search,
        ]);
        return view("back.category.index-category", compact("categories"));
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
                'name'          => 'required|string|max:255',
                'slug'          => 'required|string|max:255',
                'description'   => 'nullable|string',
            ]);

            // Ini code untuk memeriksa apakah 'name' sudah ada atau belum
            // jika belum maka akan ada toast error
            if (Categories::where('name', $request->name)->exists()) {
                return redirect()->back()->with('error','Category name already exists.');
            }

            Categories::create([
                'name'          => $request->name,
                'slug'          => $request->slug,
                'description'   => $request->description,
            ]);

            return redirect()->back()->with('success', 'Category successfully added.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Failed to added category: Database error.');
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
                'name'        => 'required|string|max:255',
                'slug'        => 'required|string|max:255|unique:categories,slug,' . $id,
                'description' => 'nullable|string',
            ]);

            $category = Categories::findOrFail($id);
            $category->update($request->only('name', 'slug', 'description'));

            return redirect()->back()->with('success', 'Category successfully updated.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Failed to update category: Name already exists.');
            }
            return redirect()->back()->with('error', 'Failed to update category: ' . $e->getMessage() . '.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categories::find($id);
        $category->delete();
        return redirect()->back()->with('deleted', 'Category deleted successfully.');
    }
}
