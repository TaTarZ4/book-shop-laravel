@extends('templates.book')

@section('head')
@endsection

@section('content')
<div class="w-75 m-auto mt-5">
    <h1 class="text-center">Order {{$order->id}}</h1>
    <table class="table">
        <thead>
            <th>No</th>
            <th>Book Name</th>
            <th>qty</th>
        </thead>
        <tbody>
            @foreach($orderBooks as $orderBook)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$orderBook->book->name}}</td>
                <td>{{$orderBook->qty}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/" class="btn btn-primary mt-5">Go back</a>
</div>
@endsection

@section('script')
@endsection