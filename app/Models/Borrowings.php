<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowings extends Model
{
    protected $table = "borrowings";
    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_date',
        'actual_return_date',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book() {
        return $this->belongsTo(Books::class, 'book_id');
    }
}
