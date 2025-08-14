<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    protected $table = "favorites";
    protected $fillable = [
        'user_id',
        'book_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function books(){
        return $this->hasMany(Books::class,'user_id');
    }
}
