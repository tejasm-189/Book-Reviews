@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h1 class="mb-2 text-2xl">{{ $book->title }}</h1>

    <div class="book-info">
        <div class="book-author mb-4 text-lg font-semibold">by {{ $book->author }}</div>
        <div class="book-rating flex items-center">
            <div class="mr-2 text-sm font-medium text-slate-700">
                {{ number_format($book->reviews_avg_rating, 1) }}
                <span class="text-xs text-slate-500">
                    out of 5
                </span>
            </div>
            <span class="text-xs text-slate-500">
                {{ $book->reviews_count }} reviews
            </span>
        </div>
    </div>
</div>

<div class="mb-4">
    <a href="{{ route('books.index') }}" class="text-blue-500 hover:text-blue-700 underline">← Back to Index</a>
</div>

<div>
    <h2 class="mb-4 text-xl font-semibold">Reviews</h2>
    <ul>
        @forelse ($book->reviews as $review)
        <li class="book-item mb-4">
            <div>
                <div class="mb-2 flex items-center justify-between">
                    <div class="font-semibold">{{ $review->rating }} / 5</div>
                    <div class="text-xs text-slate-500">{{ $review->created_at->format('M j, Y') }}</div>
                </div>
                <p class="text-gray-700">{{ $review->review }}</p>
            </div>
        </li>
        @empty
        <li class="mb-4 text-slate-500">No reviews yet</li>
        @endforelse
    </ul>
</div>
@endsection