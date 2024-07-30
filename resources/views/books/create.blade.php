@extends('layouts.app')
@section('content')
    <main class="container">
     
        <section>
            <form method="post" action="{{route('books.store')}} " enctype="multipart/form-data">
                @csrf
                <div class="titlebar">
                    <h1>Add Book</h1>
                    <button>Save</button>
                </div>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach    
                        </ul>
                    </div>
                @endif
                <div class="card">
                <div>
                        <label>Title</label>
                        <input type="text" name="title" >
                        <label>Author id(Identifiant)</label>
                        <input type="text" name="author_id" >
                        <!-- <label>Add Image</label>
                        <img src="" alt="" class="img-product" id="file-preview" />
                        <input type="file" name="image" accept="image/*" onchange="showFile(event)" > -->
                    </div>
                <div>
                        <label for="isbn">ISBN</label>
                            <input type="text" id="isbn" name="isbn" class="form-control" value="{{ old('isbn') }}">
                            @error('isbn')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        <label>Published Year</label>
                        <input type="integer" class="input" id="published_year" name="published_year" >
                        @error('published_year')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <hr>
                </div>
                </div>
                <div class="titlebar">
                    <h1></h1>
                    <button>Save</button>
                </div>
            </form>
        </section>
    </main>
    <script>
            document.addEventListener('DOMContentLoaded', function () {
                if ($errors.author_id){
                    Swal.fire({
                        title: 'Author Not Found',
                        text: 'The provided author ID does not exist. Please register the author first.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });


            function showFile(event){
                var input = event.target;
                var reader = new FileReader();
                reader.onload = function(){
                    var dataURL = reader.result;
                    var output = document.getElementById('file-preview');
                    output.src = dataURL;
                };
                reader.readAsDataURL(input.files[0]);
            }
    </script>
@endsection