@extends('layouts.app')

@section('content')
<div class="mb-10">
    <h1 class="text-4xl font-extrabold text-slate-800 mb-2">Library</h1>
    <p class="text-slate-500 text-lg">Browse our collection of reviewed books.</p>
</div>

<form method="GET" action="{{ route('books.index') }}" class="mb-12 flex gap-4 max-w-xl">
    <div class="relative w-full">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input type="text" name="title" value="{{ request('title') }}"
            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-shadow hover:shadow-md outline-none"
            placeholder="Search by title...">
    </div>
    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-4 transition-colors">
        Search
    </button>
    @if(request('title'))
    <a href="{{ route('books.index') }}" class="flex items-center justify-center text-gray-600 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-6 py-4 transition-colors">
        Clear
    </a>
    @endif
</form>

<div class="bg-gray-100 rounded-xl p-2 mb-8 inline-flex flex-wrap gap-2">
    @php
    $filters = [
    '' => 'Latest',
    'popular_last_month' => 'Popular Last Month',
    'popular_last_6months' => 'Popular Last 6 Months',
    'highest_rated_last_month' => 'Highest Rated Last Month',
    'highest_rated_last_6months' => 'Highest Rated Last 6 Months',
    ];
    @endphp

    @foreach ($filters as $key => $label)
    <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}"
        class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'bg-white text-blue-600 shadow-sm ring-1 ring-slate-900/5' : 'text-slate-600 hover:bg-white/50 hover:text-slate-900' }} px-4 py-2 rounded-lg text-sm font-medium transition-all">
        {{ $label }}
    </a>
    @endforeach
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse ($books as $book)
    <a href="{{ route('books.show', $book) }}" class="group block bg-white rounded-2xl shadow-sm border border-slate-100 p-6 transition-all hover:-translate-y-1 hover:shadow-xl hover:border-blue-100">
        <div class="flex flex-col h-full">
            <h3 class="text-xl font-bold text-slate-800 mb-1 group-hover:text-blue-600 transition-colors line-clamp-2">
                {{ $book->title }}
            </h3>
            <p class="text-slate-500 mb-4 text-sm font-medium">by {{ $book->author }}</p>

            <div class="mt-auto pt-4 border-t border-slate-100">
                @if(isset($book->filtered_reviews_count))
                <!-- Filtered Stats (Active Context) -->
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center text-blue-600 font-bold">
                        <span class="text-lg mr-1">{{ number_format($book->filtered_reviews_avg_rating, 1) }}</span>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                    </div>
                    <div class="text-xs text-blue-600 font-medium uppercase tracking-wider bg-blue-50 px-2 py-1 rounded-md">
                        {{ $book->filtered_reviews_count }} {{ Str::plural('recent', $book->filtered_reviews_count) }}
                    </div>
                </div>
                @endif

                <!-- Global Stats -->
                <div class="flex items-center justify-between {{ isset($book->filtered_reviews_count) ? 'opacity-60 grayscale' : '' }}">
                    <div class="flex items-center text-yellow-500 font-bold">
                        <span class="text-lg mr-1">{{ number_format($book->reviews_avg_rating, 1) }}</span>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                    </div>
                    <div class="text-xs text-slate-400 font-medium uppercase tracking-wider">
                        {{ $book->reviews_count }} {{ Str::plural('total', $book->reviews_count) }}
                    </div>
                </div>
            </div>
        </div>
    </a>
    @empty
    <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300">
        <p class="text-slate-500 text-lg mb-4">No books found matching your criteria.</p>
        <a href="{{ route('books.index') }}" class="text-blue-600 hover:underline">Clear filters</a>
    </div>
    @endforelse
</div>
@endsection