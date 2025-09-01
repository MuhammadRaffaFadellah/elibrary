<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Books;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index() {
        $user = Auth::user();
        $booksCount = Books::count();

        $userCount = User::where("role_id", 3)->count();
        return view("back.index-back", compact("user", "userCount", "booksCount"));
    }

    public function landing() {
        $recommendedBooks = Books::where('is_recommended', true)
        ->where('status', 'available')
        ->take(8)
        ->get();
        return view('front.landing', compact('recommendedBooks'));
    }
}
