@extends('templates.book')

@section('head')
    <style>
        .head-pos{
            text-align: center;
        }
        section{
            width: 100%;
            display: flex;
            gap: 1rem;
        }
        .pos-left{
            width: 60%;
            height: 550px;
            overflow: scroll;
            .left-item{
                .left-item-img{
                    width: 80px;
                    height: 80px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    overflow: hidden;
                    border-radius: 12px;
                    img{
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                }
            }
        }
        .pos-right{
            width: 40%;
            .right-item-name{
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 1;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .right-item-img{
                width: 80px;
                height: 80px;
                display: flex;
                justify-content: center;
                align-items: center;
                overflow: hidden;
                border-radius: 12px;
                img{
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }
            .right-list-items{
                overflow: scroll;
                height: 200px;
            }
            .right-item-qty div input{
                max-width: 80px;
            }
        }
        .right-calculate{
            .calculate{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 5px;
            }
        }
        .text-pp{
            color: #A700C2;
        }
        @media screen and (max-width : 600px){
            section{
                display: block;
            }
            .pos-left{
                width: 100%;
            }
            .pos-right{
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="pos">
        <h1 class="head-pos fw-bold">POS</h1>
        <section>
            <aside class="pos-left">
                <div class="left-search mx-4 my-2">
                    <input type="text" class="form-control" placeholder="ค้นหา">
                </div>
                <table class="left-list-items w-100">
                    <tbody>
                        @foreach($books as $book)
                        <tr class="left-item">
                            <td class="left-item-img m-1">
                                <img src="{{$book->image}}" alt=""/>
                            </td>
                            <td class="left-item-name p-2">{{$book->name}}</td>
                            <td class="left-item-price p-2">{{$book->price}}</td>
                            <td class="left-item-action fs-3 ms-4 p-2">
                                <button href="" class="left-item-add btn btn-primary" data-book='["{{$book->id}}","{{$book->image}}","{{$book->name}}","{{$book->price}}"]' >
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </aside>
            <aside class="pos-right">
                <h2 class="right-tittle text-center">Order</h2>
                <div class="right-list-items">
                    <table class="w-100" id="list-items-order">
                    </table>
                </div>
                <div class="right-calculate d-flex mt-3">
                    <div class="calculate-left w-50 p-3 border-top border-end border-1 border-black">
                        <div class="tittle text-center">Input cash</div>
                        <input type="number" class="form-control my-2" placeholder="" id="inputCash" onchange="onchangeCash()">
                        <div class="calculate">
                            <button href="" class="btn btn-primary text-center" onclick="pushNumber(7)">7</button>
                            <button href="" class="btn btn-primary text-center" onclick="pushNumber(8)">8</button>
                            <button href="" class="btn btn-primary text-center" onclick="pushNumber(9)">9</button>
                            <button href="" class="btn btn-primary text-center" onclick="pushNumber(4)">4</button>
                            <button href="" class="btn btn-primary text-center" onclick="pushNumber(5)">5</button>
                            <button href="" class="btn btn-primary text-center" onclick="pushNumber(6)">6</button>
                            <button href="" class="btn btn-primary text-center" onclick="pushNumber(1)">1</button>
                            <button href="" class="btn btn-primary text-center" onclick="pushNumber(2)">2</button>
                            <button href="" class="btn btn-primary text-center" onclick="pushNumber(3)">3</button>
                            <button href="" class="btn btn-warning text-center" onclick="clearCash()">Clear</button>
                            <button href="" class="btn btn-primary text-center" onclick="pushNumber(0)">0</button>
                            <button href="" class="btn btn-secondary text-center" onclick="pushDot('.')">.</button>
                        </div>
                    </div>
                    <div class="calculate-right w-50 p-3 border-top border-1 border-black d-flex flex-column justify-content-between">
                        <div class="">
                            <div class="calculate-right-total d-flex justify-content-between">
                                <span class="fw-bold">Total</span>
                                <span>$ <span id="c-total">0</span></span>
                            </div>
                            <div class="calculate-right-cash d-flex justify-content-between">
                                <span>Cash</span>
                                <span>$ <span id="c-cash">0</span></span>
                            </div>
                            <div class="calculate-right-change d-flex justify-content-between">
                                <span>Change</span>
                                <span class="fw-bold text-pp">$ <span id="c-change">0</span></span>
                            </div>
                        </div>
                        <button id="summit" class="btn btn-success ">Summit</button>
                    </div>
                </div>
            </aside>
        </section>
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title">Successfully</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total</span>
                        <span>$ <span id="s-total">0</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Cash</span>
                        <span>$ <span id="s-cash">0</span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Change</span>
                        <span class="fw-bold text-pp">$ <span id="s-change">0</span></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary close">ตกลง</button>
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let productsOrder = [];
        let total = 0;
        let cash = 0;
        let change = 0;
        // var a = {!! json_encode($books->toArray()) !!};

        $('#pos').addClass('menu-action');
        $('.left-item-add').click(
            function(){
                let add = $(this).data('book');
                if(productsOrder.find((e)=>e.id == add[0])){
                    productsOrder.find((e)=>(e.id == add[0])).qty += 1;
                    updateQty(add[0]);
                }else{
                    let addBook = `
                        <tr class="right-item" id="orderItem${add[0]}">
                            <td class="right-item-img">
                                <img src="${add[1]}" alt="">
                            </td>
                            <td class="right-item-detail">
                                <div class="right-item-name fw-bold">${add[2]}</div>
                                <div class="right-item-text fw-light" style="font-size: 14px;">price</div>
                                <div class="right-item-price text-pp fw-bold">$ ${add[3]}</div>
                            </td>
                            <td class="right-item-qty">
                                <div class="d-flex gap-1">
                                    <div class="right-qty-dash btn border border-dark border-2 rounded-end-0" onclick="reduceQty(${add[0]})"><i class="bi bi-dash-lg"></i></div>
                                    <input type="number" class="right-qty border border-dark border-2 text-center" value="1" min="1" onchange="inputQty(${add[0]} , this)"/>
                                    <div class="right-qty-plus btn border border-dark border-2 rounded-start-0" onclick="increaseQty(${add[0]})"><i class="bi bi-plus-lg"></i></div>
                                </div>
                            </td>
                            <td class="right-item-action">
                                <button href="" class="left-item-delete btn btn-danger" onclick="deleteItemOrder(${add[0]})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `
                    $('#list-items-order').append(addBook);
                    productsOrder.push({"id":add[0],"qty":1,"price":add[3]});
                    updateTotal();
                }
            }
        );
        function deleteItemOrder (e){
            $(`#orderItem${e}`).remove();
            let newProducts = productsOrder.filter((product)=>{
                return product.id != e;
            })
            productsOrder = newProducts;
        };
        function updateQty(id){
            const num = productsOrder.find((e)=>(e.id == id)).qty;
            $(`#orderItem${id} input`).val(num);
            updateTotal();
            // console.log(productsOrder);
        };
        function increaseQty(id){
            productsOrder.find((e)=>(e.id == id)).qty += 1;
            updateQty(id);
        };
        function reduceQty(id){
            if(productsOrder.find((e)=>(e.id == id)).qty > 1){
                productsOrder.find((e)=>(e.id == id)).qty -= 1;
            }
            updateQty(id);
        };
        function inputQty(id , e){
            const Qty = $(e).val();
            productsOrder.find((e)=>(e.id == id)).qty = Number(Qty);
            updateQty(id);
        };
        async function updateTotal(){
            total = 0;
            await productsOrder.map((e)=>{
                total += (e.price * e.qty);
            })
            change = Number(cash) - total;
            $('#c-total').html(total);
            $('#c-change').html(change);
        };
        function pushNumber(num){
            if(cash == 0){
                cash += num;
            }else{
                cash += String(num);
            }
            $('#c-cash').html(cash);
            $('#inputCash').val(cash);
            updateTotal()
        };
        function onchangeCash(){
            const newCash = $('#inputCash').val();
            cash = newCash;
            $('#c-cash').html(cash);
            updateTotal()
        }
        function pushDot(num){
            cash += String(num);
        };
        function clearCash(){
            cash = 0;
            $('#c-cash').html(cash);
            $('#inputCash').val(0);
            updateTotal()
        };
        function resetOrder(){
            cash = 0;
            total = 0;
            change = 0;
            productsOrder = [];
            $('#c-cash').html(cash);
            $('#c-total').html(total);
            $('#c-change').html(change);
            $('#inputCash').val(0);
            $('#list-items-order').html('');

        }
        $('#summit').click(()=>{
            $('#s-cash').html(cash);
            $('#s-total').html(total);
            $('#s-change').html(change);
            $('#myModal').modal('show'); 
            resetOrder();   
        });
        $('.close').click(()=>{
            $('#myModal').modal('hide');
        })

    </script>
@endsection