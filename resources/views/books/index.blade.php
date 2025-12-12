@extends('layouts.app')

@section('content')
<h1>Books</h1>
<ul>
    @forelse ($books as $book)
    <li>
        <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
    </li>
    @empty
    <li>No books found</li>
    @endforelse
</ul>
@endsection