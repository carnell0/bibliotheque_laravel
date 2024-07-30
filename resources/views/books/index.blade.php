@extends('layouts.app')
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>Books</h1>
            <a href="{{ route('books.create') }}" class="btn-link">Add Book</a>
        </div>
        @if ($message = Session::get('success'))
            <script type="text/javascript">
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "{{$message}}"
                });
            </script>
        @endif
        <div class="table">
            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li>
                            <p class="table-filter-link link-active">All</p>
                        </li>
                    </ul>
                </div>
            </div>
            <form method="get" action="{{ route('books.index') }}" accept-charset="UTF-8" role="search">
                <div class="table-search">
                    <div>
                        <button class="search-select">
                            Search Book
                        </button>
                        <span class="search-select-arrow">
                            <i class="fas fa-caret-down"></i>
                        </span>
                    </div>
                    <div class="relative">
                        <input class="search-input" type="text" name="search" placeholder="Search book..." value="{{ request('search') }}">
                    </div>
                </div>
            </form>
            <table class="table" table-bordered border-primary>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Published Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($books) > 0)
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author->name }}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>{{ $book->published_year }}</td>
                                <td style="display: flex">
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn-link btn btn-success" style="padding-top: 4px; padding-bottom: 4px;">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form method="post" action="{{ route('books.destroy', $book->id) }}" style="margin-left: 10px;">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" onclick="deleteConfirm(event)">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No books found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="table-paginate">
                {{$books->links('layouts.pagination')}}
            </div>
        </div>
    </section>
</main> 
<script>
    window.deleteConfirm = function (e) {
        e.preventDefault();
        var form = e.target.form;
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>       
@endsection
