<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Borrowings;

class Books extends Model
{
    protected $table = "books";
    protected $fillable = [
        'title',
        'slug',
        'author',
        'publisher',
        'year_published',
        'isbn',
        'description',
        'cover_image',
        'file_path',
        'stock',
        'status',
    ];

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'book_category');
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowings::class, 'book_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorites::class, 'book_id');
    }
}
