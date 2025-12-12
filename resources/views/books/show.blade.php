@extends('layouts.app')

@section('content')
<div class="mb-8">
    <a href="{{ route('books.index') }}" class="inline-flex items-center text-slate-500 hover:text-blue-600 transition-colors font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Library
    </a>
</div>

<!-- Book Card -->
<div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 mb-10 relative overflow-hidden">
    <!-- Decoration -->
    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-gradient-to-br from-blue-50 to-purple-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

    <div class="relative z-10 flex flex-col md:flex-row gap-8 items-start">
        <!-- Cover Placeholder -->
        <div class="w-full md:w-48 aspect-[2/3] bg-gradient-to-tr from-slate-200 to-slate-100 rounded-xl shadow-inner flex items-center justify-center text-slate-400 shrink-0">
            <svg class="w-16 h-16 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>

        <div class="flex-1">
            <h1 class="text-4xl font-extrabold text-slate-800 mb-2 leading-tight">{{ $book->title }}</h1>
            <div class="text-xl text-slate-500 font-medium mb-6">by {{ $book->author }}</div>

            <div class="flex items-center gap-6 mb-8">
                <div class="flex items-center">
                    <div class="flex text-yellow-500 mr-3">
                        <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-slate-800">{{ number_format($book->reviews_avg_rating, 1) }}</div>
                        <div class="text-xs text-slate-500 uppercase tracking-wide font-semibold">Average Rating</div>
                    </div>
                </div>
                <div class="w-px h-12 bg-slate-200"></div>
                <div>
                    <div class="text-2xl font-bold text-slate-800">{{ $book->reviews_count }}</div>
                    <div class="text-xs text-slate-500 uppercase tracking-wide font-semibold">Total Reviews</div>
                </div>
            </div>

            <button class="bg-slate-900 text-white px-6 py-3 rounded-xl font-semibold hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/10 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Write a Review
            </button>
        </div>
    </div>
</div>

<!-- Reviews Section -->
<div>
    <h2 class="text-2xl font-bold text-slate-800 mb-6">Reviews</h2>

    <div class="space-y-6">
        @forelse ($book->reviews as $review)
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center">
                    <!-- Star Rating display -->
                    <div class="flex text-yellow-400 text-sm">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <=$review->rating)
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                            @else
                            <svg class="w-4 h-4 text-slate-200 fill-current" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                            @endif
                            @endfor
                    </div>
                    <span class="ml-2 text-slate-800 font-semibold">{{ $review->rating }}.0</span>
                </div>
                <div class="text-slate-400 text-sm font-medium">
                    {{ $review->created_at->diffForHumans() }}
                </div>
            </div>
            <p class="text-slate-600 leading-relaxed">{{ $review->review }}</p>
        </div>
        @empty
        <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-slate-300">
            <p class="text-slate-500 mb-2">No reviews yet.</p>
            <p class="text-sm text-slate-400">Be the first to share your thoughts!</p>
        </div>
        @endforelse
    </div>
</div>
@endsection