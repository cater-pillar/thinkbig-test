<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        if(auth()->guest()) {
            return view('register/create');
        }
        $books = Book::all()->sortBy('naziv_knjige');
        if (request('search')) {
            $search = request('search');
            $searchedBooks = $books->filter(function($book) use ($search) {
                if (stripos($book->naziv_knjige, $search) !== false) {
                    return $book;
                }
            });
            $books = $searchedBooks;
        }

        if (request('age')) {
            $filteredBooks = $books;

            if(request('age') == "until5") {
                $filteredBooks = $books->filter(function($book) {if($book->age() <= 5) return $book;});
            }
            if(request('age') == "until10") {
                $filteredBooks = $books->filter(function($book) {if($book->age() <= 10) return $book;});
            }
            if(request('age') == "above10") {
                $filteredBooks = $books->filter(function($book) {if($book->age() > 10) return $book;});
            }
            
            $books = $filteredBooks;
        }

        return view('home', ['books' => $books]);
    }

}
