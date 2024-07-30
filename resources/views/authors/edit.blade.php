@extends('layouts.app')
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>Edit Author</h1>
        </div>
        <form action="{{ route('authors.update', $author->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $author->name) }}">
                @error('name')      
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="biography">Biography</label>
                <textarea id="biography" name="biography" class="form-control">{{ old('biography', $author->biography) }}</textarea>
                @error('biography')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </section>
</main>
@endsection
