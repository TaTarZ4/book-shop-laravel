@extends('templates.book')
@section('head')
<style>
    .container {
        width: 800px;
        margin: auto;
        margin-top: 2rem;
        
        .tittle {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            .img {
                margin: auto;
                display: flex;
                width: 200px;
                height: 300px;
                justify-content: center;
                align-items: center;
                img{
                    object-fit: cover;
                    width: 100%;
                    height: 100%;
                }
            }
            .tittle-right{
                text-align: center;
                .tittle-text {
                    font-size: large;
                    font-weight: 800;
                    margin: 1rem;
                }
                .tittle-category{
                    display: flex;
                    gap: 1rem;
                    justify-content: center;
                }
            }
        }
        .description {
            margin-top: 2rem;
        }
    }
</style>
@endsection

@section('content')
<main>
    <div class="container">
        <div class="tittle">
            <div class="img">
                <img src="{{$book->image}}" alt="">
            </div>
            <div class="tittle-right">
                <div class="tittle-text">{{$book->name}}</div>
                <div class="tittle-price">{{$book->price}} บาท</div>
                <div class="tittle-category">
                    <div class="">หมวดหมู่:</div>
                    @foreach($book->category_book as $category)
                    <div class="item">{{$category->name}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="description">{{$book->description}}</div>
        <div class="action m-5">
        <a href="/book/index" class="btn btn-primary">Go Back</a>
        </div>
    </div>  
</main>
@endsection

@section('script')
    <script>
        $('#stocks').addClass('menu-action');
    </script>
@endsection