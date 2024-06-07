@extends('templates.book')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        section{
            width: 1150px;
            margin: 30px auto 0 auto;
            h2{
                margin: auto;
                text-align: center;
            }

            .manage-book{
                text-align: end;
                margin: 45px 0 45px 0;
            }
            article{
                display: grid;
                grid-template-columns: repeat(5 , 1fr);
                gap: 25px;

                .item{
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    box-shadow: 0 4px 4px 0 #00000025;
                    border-radius: 12px;

                    a:link { text-decoration: none; }
                    a:visited { text-decoration: none; }
                    a:hover { text-decoration: none; }
                    a:active { text-decoration: none; }

                    .img{
                        width: 100%;
                        height: 280px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        border-radius: 12px 12px 0 0;
                        overflow: hidden;
                        img{
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }
                    }

                    p{
                        padding: 5px 10px 5px 10px;
                        margin: 0;
                        color: black;
                        text-decoration-line: none;
                    }

                    .qty , .price{
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        gap: 3px;
                        padding: 0 10px 0 10px;
                    }

                    .add-stock {
                        width: 100%;
                        border-radius: 0 0 12px 12px;
                        i{
                            color: #fff;
                            font-size: 25px;
                        }
                    }
                }
            }
            
        }
    </style>
@endsection

@section('content')
    <section>
        <h2>Books Stocks</h2>
        <div class="manage-book">
            <a href="/book/index" class="btn btn-warning btn-manage">Management</a>
        </div>
        
        <article class="mb-5">
            @foreach($books as $book)
                <div class="item" id="book{{$book->id}}">
                    <a href="/book/show/{{$book->id}}">
                        <div class="img">
                            <img src="{{ $book->image}}" alt="">
                        </div>
                        <p>{{$book->name}}</p>
                    </a>
                    <div class="description">
                        <div class="qty">
                            <i class="bi bi-box"></i>
                            <span>{{$book->qty}}</span>
                        </div>
                        <div class="price">
                            <i class="bi bi-currency-dollar"></i>
                            <span>{{$book->price}}</span>
                        </div>
                        <a class="btn btn-success add-stock add-stock">
                            <input type="text" value="{{$book->id}}" style="display: none;" name="book_id">
                            <i class="bi bi-plus-square-fill"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </article>
    </section>
    
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myInput">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="modalHide()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h6>เพื่มจำนวนสินค้า</h6>
            <input type="text" class="form-control" placeholder="จำนวนสินค้า" name="qty">
            <input type="text" value="" style="display: none;" name="book_id">
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <a class="btn btn-warning" href="">History</a>
            <div class="modal-footer-right">
                <button type="button" class="btn btn-primary" id="summit-stock">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="modalHide()">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

<!-- Button trigger modal -->

@section('script')
    <script>
        // const get = async() => {
        //     const response = await fetch('/book/getApi');
        //     const data = await response.json();
        //     console.log(data)
        // };
        // console.log('aa');
        // get();
        $('#stocks').addClass('menu-action');

        $('.add-stock').on('click', function () {
            $('#myInput').modal('show');

            let val = $(this).find('input[name=book_id]').val();
            $('#myInput').find('input[name=book_id]').val(val);
            $('#myInput').find('a').attr('href',`/book/show/${val}`)
        });
        
        function modalHide () {
            $('#myInput').modal('hide');
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $("#summit-stock").click(function(e){
    
            e.preventDefault();
    
            var qty = $("#myInput").find("input[name=qty]").val();
            var book_id = $("#myInput").find("input[name=book_id]").val();
    
            $.ajax({
                type:'POST',
                url:"/api/stock/add",
                data:{qty:qty, book_id:book_id},
                success:function(data){
                    // alert('เพิ่ม สินค้า สำเร็จ');
                    var bookId = $(`#book${data.book.id}`).find('.qty span').text(data.book.qty);
                    var reQty = $("#myInput").find("input[name=qty]").val('');
                    // console.log(data.book.qty);
                }
            });

            $('#myInput').modal('hide');
    
        });

        // $.ajax({
        //     url: "/api/categories",
        //     type: 'GET',
        //     dataType: 'json', // added data type
        //     success: function(res) {
        //         console.log(res);
        //         alert(res);
        //     }
        // });
    </script>
@endsection