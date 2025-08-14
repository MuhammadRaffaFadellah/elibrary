<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Books as Book;

class Categories extends Model
{
    protected $table = "categories";
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function books(){
        return $this->hasMany(Book::class);
    }
}
