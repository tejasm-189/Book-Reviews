<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        return view('books.reviews.create', ['book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        $data = $request->validate([
            'review' => 'required|min:15',
            'rating' => 'required|min:1|max:5|integer'
        ]);

        $book->reviews()->create($data);

        // INVALIDATE CACHE
        // We forget the specific key that holds this book's data
        cache()->forget('book:' . $book->id);

        return redirect()->route('books.show', $book)
            ->with('flash_message', 'Review submitted successfully!')
            ->with('flash_class', 'bg-green-100 text-green-700 border-green-200');
    }
}
