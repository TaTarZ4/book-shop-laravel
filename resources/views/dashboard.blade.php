@extends('templates.book')

@section('head')
    <style>
        .action {
            margin: auto;
            margin-top: 2rem;
            /* text-align: center; */
            width: 800px;
        }
        .book-list {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
            gap: 1rem;
            margin: auto;
            margin-top: 2rem;
            width: 800px;
            h5 , p {
                font-size: small;
            }
            .tittle{
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .price {
                text-align: end;
            }
        }
    </style>
@endsection

@section('content')
    <div class="action">
        <a href="/book/index" class="btn btn-warning">Manage Books</a>
    </div>
    <div class="book-list">
        @foreach($books as $book)         
                <div class="card g-col-1">
                    <a href="/book/show/{{$book->id}}">
                        <img src="{{ $book->image }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title tittle">{{$book->name}}</h5>
                            <p class="card-text price">{{$book->price}} บาท</p>
                        </div>
                    </a>
                </div> 
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        const get = async() => {
            const response = await fetch('/book/getApi');
            const data = await response.json();
            console.log(data)
        };
        console.log('aa');
        get();
    </script>
@endsection