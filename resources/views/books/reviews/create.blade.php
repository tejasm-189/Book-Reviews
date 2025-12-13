@extends('layouts.app')

@section('content')
<div class="mb-8">
    <a href="{{ route('books.show', $book) }}" class="inline-flex items-center text-slate-500 hover:text-blue-600 transition-colors font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Book
    </a>
</div>

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 relative overflow-hidden">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-2">Write a Review</h1>
        <p class="text-slate-500 mb-8">Share your thoughts on <span class="font-bold text-slate-700">{{ $book->title }}</span></p>

        <form action="{{ route('books.reviews.store', $book) }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="review" class="block text-slate-700 font-semibold mb-2">Review</label>
                <textarea name="review" id="review" rows="5" required
                    class="w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-slate-700"
                    placeholder="What did you like or dislike?">{{ old('review') }}</textarea>
                @error('review')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="rating" class="block text-slate-700 font-semibold mb-2">Rating</label>
                <select name="rating" id="rating" required
                    class="w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-slate-700">
                    <option value="">Select a rating</option>
                    @for ($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                    @endfor
                </select>
                @error('rating')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('books.show', $book) }}" class="text-slate-500 font-semibold hover:text-slate-700 transition-colors">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                    Submit Review
                </button>
            </div>
        </form>
    </div>
</div>
@endsection