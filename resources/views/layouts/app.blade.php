<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-danger">
  
    <h1>Library Management</h1>
    
      <ul class="float-list" style="display: flex;
    padding: 5px;
    margin: 2px;
    padding-right: 3px;
    list-style: none;">
        <li class="nav-item">
          <a href="{{route('books.index')}}" class="btn btn-link" aria-current="page">View Books</a>
        </li>
        <li class="nav-item">
          <a href="{{route('authors.index')}}" class="btn btn-link">View Authors</a>
        </li>
      </ul>
 
</nav>

    <div class="container">
        @yield('content')
    </div>
</body>
<footer>
    Designed By Carnell Thon
</footer>
</html>
