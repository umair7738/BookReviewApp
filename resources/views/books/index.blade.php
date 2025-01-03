@extends('layouts.app2')

@section('content')

    @if ($books->isNotEmpty())
        <h1>Books</h1>
        <div class="list-group">
            @foreach ($books as $book)
                <a href="{{ route('books.show', $book->id) }}" class="list-group-item list-group-item-action">
                    {{ $book->title }}
                </a>
            @endforeach
        </div>
    @else
        <p>No books found.</p>
    @endif

@endsection
