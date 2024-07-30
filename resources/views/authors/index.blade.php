@extends('layouts.app')

@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>Authors</h1>
            <a href="{{ route('authors.create') }}" class="btn-link">Add Author</a>
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
            <form method="get" action="{{ route('authors.index') }}" accept-charset="UTF-8" role="search">
                <div class="table-search">
                    <div>
                        <button class="search-select">
                            Search Author
                        </button>
                        <span class="search-select-arrow">
                            <i class="fas fa-caret-down"></i>
                        </span>
                    </div>
                    <div class="relative">
                        <input class="search-input" type="text" name="search" placeholder="Search author..." value="{{ request('search') }}">
                    </div>
                </div>
            </form>
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Biography</th>
                        <th>Books</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($authors) > 0)
                        @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author->id }}</td>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->biography }}</td>
                                <td>
                                    <ul>
                                        @foreach($author->books as $book)
                                            <li>{{ $book->title }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td style="display: flex">
                                    <a href="{{ route('authors.edit', $author->id) }}" class="btn-link btn btn-success" style="padding-top: 4px; padding-bottom: 4px;">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form method="post" action="{{ route('authors.destroy', $author->id) }}" style="margin-left: 10px;">
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
                            <td colspan="5">No authors found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="table-paginate">
                {{ $authors->links('layouts.pagination') }}
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
