<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books as Book;
use App\Models\Categories;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = $request->get('order', 'asc');
        $search = $request->get('search');

        // query
        $query = Book::query()->with('categories');
        $categories = Categories::all();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('publisher', 'like', "%{$search}%")
                    ->orWhere('year_published', 'like', "%{$search}%");
            });
        }

        $books = $query->orderBy('title', $order)->paginate(7)->appends([
            $order,
            $search,
        ]);
        return view("back.book.index-book", compact("books", "order", "search", "categories"));
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
            $validated = $request->validate([
                'categories'   => 'required|array',
                'categories.*'   => 'exists:categories,id',
                'title'         => 'required|string|max:255',
                'author'        => 'required|string|max:255',
                'publisher'     => 'required|string|max:255',
                'year_published' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
                'isbn'          => 'nullable|string|max:255',
                'description'   => 'nullable|string',
                'cover_image'   => 'nullable|image|mimes:jpg, jpeg, png|max:2049',
                'stock'         => 'required|integer|min:0',
                'file_path'     => 'nullable|mimes:pdf, epub, doc, docx|max:5120',
            ]);

            $validated['slug'] = Str::slug($validated['title']);
            $validated['status'] = 'available';

            if ($request->hasFile('cover_image')) {
                $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
            }

            if ($request->hasFile('file_path')) {
                $validated['file_path'] = $request->file('file_path')->store('books', 'public');
            }

            $book = Book::create($validated);

            $book->categories()->attach($request->categories);

            return redirect()->back()->with('succes', 'Book successfully added');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Failed to add book: ' . $e->getMessage() . '.');
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
            $book = Book::findOrFail($id);

            $validated = $request->validate([
                'categories'       => 'nullable|array',
                'categories.*'     => 'exists:categories,id',
                'title'            => 'required|string|max:255',
                'slug'             => 'nullable|string|max:255',
                'author'           => 'required|string|max:255',
                'publisher'        => 'required|string|max:255',
                'description'      => 'nullable|string',
                'year_published'   => 'required|integer|digits:4',
                'stock'            => 'required|integer|min:0',
                'isbn'             => 'nullable|string|max:20',
                'cover_image'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'file_path'        => 'nullable|file|mimes:pdf,epub,mobi,doc,docx|max:5120',
            ]);

            // COVER
            if ($request->hasFile('cover_image')) {
                if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                    Storage::disk('public')->delete($book->cover_image);
                }
                $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
            } else {
                $validated['cover_image'] = $book->cover_image; // keep lama
            }

            // FILE
            if ($request->hasFile('file_path')) {
                if ($book->file_path && Storage::disk('public')->exists($book->file_path)) {
                    Storage::disk('public')->delete($book->file_path);
                }
                $validated['file_path'] = $request->file('file_path')->store('files', 'public');
            } else {
                $validated['file_path'] = $book->file_path; // keep lama
            }

            $book->update($validated);

            // KATEGORI (biarkan tetap, kecuali dikirim)
            if ($request->has('categories') && is_array($request->categories)) {
                $book->categories()->sync($request->categories);
            }

            return back()->with('success', 'Book updated successfully.');
        } catch (QueryException $e) {
            return back()->with('error', 'Failed to update book: ' . $e->getMessage() . '.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
