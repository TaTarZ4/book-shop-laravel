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
<main class="container">
    <form method="POST" action="/book/update/{{$book->id}}">
        @csrf
        @method('PUT')
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">name</span>
            <input name="name" class="form-control" placeholder="name" aria-describedby="basic-addon1" value="{{$book->name}}">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">image address</span>
            <input name="image" type="text" class="form-control" placeholder="image address" aria-describedby="basic-addon1" value="{{$book->image}}">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">price</span>
            <input name="price" type="text" class="form-control" placeholder="price" aria-describedby="basic-addon1" value="{{$book->price}}">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">qty</span>
            <input name="qty" type="text" class="form-control" placeholder="qty" aria-describedby="basic-addon1" value="{{$book->qty}}">
        </div>
        <div class="check-category m-3 d-flex gap-5">
            <div class="">Categories</div>
            <div class="list-item">
                @foreach($categories as $category)
                <div class="form-check item">
                    <input name="categories[]" class="form-check-input" type="checkbox" value="{{$category->id}}" id="{{$category->name}}" @checked(in_array($category->id, old('category', $book->category_book->pluck('id')->toArray())))>
                    <label class="form-check-label" for="{{$category->name}}">{{$category->name}}</label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Description</span>
            <input name="description" type="text" class="form-control" placeholder="Description" aria-describedby="basic-addon1" value="{{$book->description}}">
        </div>
        <div class="action">
            <a href="/book/index" class="btn btn-primary">Go back</a>
            <button type="submit" class="btn btn-success">submit</button>
        </div>
    </form>
</main>
@endsection

@section('script')
    <script>
        $('#stocks').addClass('menu-action');
    </script>
@endsection