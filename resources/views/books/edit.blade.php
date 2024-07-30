@extends('layouts.app')
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>Edit Book</h1>
        </div>
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $book->title) }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="author_id">Author</label>
                <select id="author_id" name="author_id" class="form-control">
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                    @endforeach
                </select>
                @error('author_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
                @error('isbn')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="published_year">Published Year</label>
                <input type="text" id="published_year" name="published_year" class="form-control" value="{{ old('published_year', $book->published_year) }}">
                @error('published_year')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $book->quantity) }}">
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
</main>
@endsection
