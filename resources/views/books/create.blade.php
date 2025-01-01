@extends('layouts.app2')

@section('content')
    <h1>Add a New Book</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" required>
        <label for="description">Description</label>
        <textarea name="description" required></textarea>
        <button type="submit">Add Book</button>
    </form>
@endsection
