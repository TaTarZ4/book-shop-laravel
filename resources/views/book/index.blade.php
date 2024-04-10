@extends('templates.book')
@section('head')
<style>
    .container {
        width: 800px;
        margin: auto;
        margin-top: 2rem;
    }
</style>
@endsection

@section('content')
<body class="container">
    <nav class="d-flex flex-row justify-content-between">
        <div class="action g-5">
            <a href="/" class="btn btn-primary">Go back</a>
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
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <th>{{$book->id}}</th>
                    <th>{{$book->name}}</th>
                    <th>{{$book->price}}</th>
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
</body>
@endsection

@section('script')
@endsection