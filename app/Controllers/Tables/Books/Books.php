<?php

namespace App\Controllers\Tables\Books;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Books extends Controller
{
    public function index()
    {
        $books = DB::table('books')->get();
        return view('books.display', ['books' => $books]);
    }
}
