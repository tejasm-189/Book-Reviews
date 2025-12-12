<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = request('title');
        $filter = request('filter', '');

        $books = \App\Models\Book::when($title, fn($query, $title) => $query->title($title));

        $books = match ($filter) {
            'popular_last_month' => $books->popular(now()->subMonth(), now())
                ->highestRated(now()->subMonth(), now())
                ->minReviews(2),
            'popular_last_6months' => $books->popular(now()->subMonths(6), now())
                ->highestRated(now()->subMonths(6), now())
                ->minReviews(5),
            'highest_rated_last_month' => $books->highestRated(now()->subMonth(), now())
                ->popular(now()->subMonth(), now())
                ->minReviews(2),
            'highest_rated_last_6months' => $books->highestRated(now()->subMonths(6), now())
                ->popular(now()->subMonths(6), now())
                ->minReviews(5),
            default => $books->latest()->withAvg('reviews', 'rating')->withCount('reviews'),
        };

        // $books = $books->get(); // Old simple get

        // Use cache for performance if needed, but for now simple get
        $books = $books->get();

        return view('books.index', ['books' => $books]);
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
        //
    }



    public function show(int $id)
    {
        $cacheKey = 'book:' . $id;

        if (cache()->has($cacheKey)) {
            $book = cache()->get($cacheKey);
            session()->now('flash_message', 'Loaded from Cache ⚡️');
            session()->now('flash_class', 'bg-green-100 text-green-700 border-green-200');
        } else {
            $book = \App\Models\Book::with([
                'reviews' => fn($query) => $query->latest()
            ])->withCount('reviews')->withAvg('reviews', 'rating')->findOrFail($id);

            cache()->put($cacheKey, $book, 3600);
            session()->now('flash_message', 'Loaded from Database 💽');
            session()->now('flash_class', 'bg-blue-100 text-blue-700 border-blue-200');
        }

        return view('books.show', ['book' => $book]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
