@extends('templates.book')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="main w-75 m-auto">
        <h1 class="text-center">Customer Member</h1>
        <section class="create-member d-flex mb-3">
            <input type="text" class="form-control" placeholder="Name" name="name">
            <input type="text" class="form-control mx-2" placeholder="Phone" name="phone">
            <a class="btn btn-warning" id="create-member">Create</a>
        </section>
        <div id="notify"></div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        //menu css in navbar
        $('#people').addClass('menu-action');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        function getCustomer(){
            $.ajax({
                type:'GET',
                url:'/customer/getCustomers',
                success: (res)=>{
                    // console.log(res.customers);
                    let html = '';
                    res.customers.map((e , index)=>{
                        html += `<tr>
                                    <td>${index+1}</td>
                                    <td>${e.name}</td>
                                    <td>${e.phone}</td>
                                    <td>
                                        <a class="btn btn-warning" onclick="updateMember(this , ${e.id})">update</a>
                                        <a class="btn btn-danger" onclick="deleteMember(this , ${e.id})">delete</a>
                                    </td>
                                </tr>`
                    })
                    $('table tbody').html(html);
                }
            })
        }

        getCustomer();

        $('#create-member').click(()=>{
            let name = $('input[name="name"]').val();
            let phone = $('input[name="phone"]').val();
            
            $.ajax({
                type:'POST',
                url: '/customer/store',
                data: {name:name , phone:phone},
                success: (res)=>{
                    // console.log(res.status);
                    $('input[name="name"]').val('');
                    $('input[name="phone"]').val('');

                    getCustomer();

                    if(res.status == 'success'){
                        $('#notify').text('* add member success');
                        $('#notify').css({'font-size':'14px','color':'green'});
                    }else{
                        $('#notify').text('* add member fail');
                        $('#notify').css({'font-size':'14px','color':'red'});
                    }
                }
            });
        })

        function deleteMember(e , id){
            $.ajax({
                type:'DELETE',
                url:`/customer/destroy/${id}`,
                success: (res)=>{
                    // console.log(res.status);
                    $(e).parent().parent().remove();

                    if(res.status == 'success'){
                        $('#notify').text('* delete member success');
                        $('#notify').css({'font-size':'14px','color':'green'});
                    }else{
                        $('#notify').text('* delete member fail');
                        $('#notify').css({'font-size':'14px','color':'red'});
                    }
                }
            })
        }

        function updateMember(e , id){
            let name = $(e).parent().parent().children('td:nth-child(2)').html();
            let phone = $(e).parent().parent().children('td:nth-child(3)').html();

            $(e).parent().parent().children('td:nth-child(2)').html(`<input class="form-control" value="${name}"/>`);
            $(e).parent().parent().children('td:nth-child(3)').html(`<input class="form-control" value="${phone}"/>`);

            $(e).parent().html(`
                <a class="btn btn-success" onclick="summitUpdateMember(this , ${id})">summit</a>
                <a class="btn btn-danger" onclick="cancelUpdateMember(this , ${id} , '${name}' , '${phone}')">cancel</a>
                `)
        }

        function summitUpdateMember(e , id){
            let name = $(e).parent().parent().children('td:nth-child(2)').children('input').val();
            let phone = $(e).parent().parent().children('td:nth-child(3)').children('input').val();

            $.ajax({
                type:"PUT",
                url:`/customer/update/${id}`,
                data:{id:id , name:name , phone:phone},
                success: (res)=>{
                    // console.log(res.data.phone);
                    $(e).parent().parent().children('td:nth-child(2)').html(`${res.data.name}`);
                    $(e).parent().parent().children('td:nth-child(3)').html(`${res.data.phone}`);

                    $(e).parent().html(`
                        <a class="btn btn-warning" onclick="updateMember(this , ${res.data.id})">update</a>
                        <a class="btn btn-danger" onclick="deleteMember(this , ${res.data.id})">delete</a>
                    `)

                    if(res.status == 'success'){
                        $('#notify').text('* update member success');
                        $('#notify').css({'font-size':'14px','color':'green'});
                    }else{
                        $('#notify').text('* update member fail');
                        $('#notify').css({'font-size':'14px','color':'red'});
                    }
                }
            })
        }

        function cancelUpdateMember(e , id , name , phone){
            // console.log(name , phone);
            $(e).parent().parent().children('td:nth-child(2)').html(`${name}`);
            $(e).parent().parent().children('td:nth-child(3)').html(`${phone}`);
            $(e).parent().html(`
                        <a class="btn btn-warning" onclick="updateMember(this , ${id})">update</a>
                        <a class="btn btn-danger" onclick="deleteMember(this , ${id})">delete</a>
                    `)
        }
    </script>
@endsection