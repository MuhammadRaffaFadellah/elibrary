<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Borrowings;

class Books extends Model
{
    protected $table = "books";
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author',
        'publisher',
        'year_published',
        'isbn',
        'description',
        'cover_image',
        'stock',
        'file_path',
        'status',
    ];

    public function category() {
        return $this->belongsToMany(Categories::class, 'category_id');
    }

    public function borrowings(){
        return $this->hasMany(Borrowings::class, 'book_id');
    }

    public function favorites(){
        return $this->hasMany(Favorites::class,'book_id');
    }
}
