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
    <form method="post" action="/book/store">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">name</span>
            <input name="name" class="form-control" placeholder="name" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">image address</span>
            <input name="image" type="text" class="form-control" placeholder="image address" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">price</span>
            <input name="price" type="text" class="form-control" placeholder="price" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Description</span>
            <input name="description" type="text" class="form-control" placeholder="Description" aria-describedby="basic-addon1">
        </div>
        <div class="action">
            <a href="/book/index" class="btn btn-primary">Go back</a>
            <button type="submit" class="btn btn-success">submit</button>
        </div>
    </form>
</body>
@endsection

@section('script')
@endsection