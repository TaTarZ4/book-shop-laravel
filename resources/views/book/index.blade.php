@extends('templates.book')
@section('head')
<style>
    .container {
        /* width: 800px; */
        margin: auto;
        margin-top: 2rem;
    }
</style>
@endsection

@section('content')
<main class="container">
    <h1 class="text-center m-5">Management Books</h1>
    <nav class="d-flex flex-row justify-content-between">
        <div class="action g-5">
            <a href="/stocks" class="btn btn-primary">Go back</a>
            <a href="/book/create" class="btn btn-success">New Book</a>
        </div>
        <div class="action g-5">
            <a href="/book/categories" class="btn btn-dark">Management category</a>
        </div>
    </nav>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">qty</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <th>{{$book->id}}</th>
                    <th>{{$book->name}}</th>
                    <th>{{$book->price}}</th>
                    <th>{{$book->qty}}</th>
                    <th style="display: flex; gap: 5px;">
                        <a href="/book/show/{{$book->id}}" class="btn btn-primary">Show</a>
                        <form action="/book/edit/{{ $book->id}}">
                            <button class="btn btn-warning">Edit</button>
                        </form>
                        <form method="post" action="/book/delete/{{$book->id}}">
                            @csrf
                            @method('Delete')
                            <button type="summit" class="btn btn-danger">delete</button>
                        </form>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection

@section('script')
    <script>
        $('#stocks').addClass('menu-action');
    </script>
@endsection