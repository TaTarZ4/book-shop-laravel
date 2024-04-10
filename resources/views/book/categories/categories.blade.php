@extends('templates.book')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .container-custom {
        width: 600px;
        margin: auto;
        margin-top: 2rem;
    }
</style>
@endsection

@section('content')
    <div class="container-custom">
        <a href="/" class="btn btn-primary">home</a>
        <button id="btn-create" class="btn btn-success m-1" onclick="create()">create</button>
        <div id="input"></div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">action</th>
                </tr>
            </thead>
            <tbody id=tbody><div class="">
            </tbody>
        </table>
    </div>
@endsection

@section('script')
<script>

    const get = async ()=>{
        const getData = await fetch('/api/categories')
        const response = await getData.json()
        const data = response.data
        let innerHtml = ''
        data.map((q) =>{
            innerHtml += `<tr>
                <td>${q.id}</td>
                <td>${q.name}</td>
                <td>
                    <div class="btn btn-warning me-1" onclick="update(${q.id})">Edit</div>
                    <div class="btn btn-danger" onclick="deleteCategory(${q.id})">delete</div>
                </td>
            </tr>`
        })
        // console.log(innerHtml)
        const tbody = document.querySelector('#tbody').innerHTML = innerHtml
    }

    const create = async ()=>{
        const html = `
            <form class="d-flex flex-row gap-1">
            @csrf
            <input id="name" type="text" class="form-control" placeholder="Name">
            <div class="btn btn-success" onclick="summitCreate()">summit</div>
            <div class="btn btn-danger" onclick="cancel()">cancel</div>
            </form>
        `
        const reset = await document.querySelector('#input form')
        if(reset){
            reset.remove()
        }
        document.querySelector('#input').innerHTML = html
        document.querySelector('#btn-create').style.visibility = "hidden"
    }

    const cancel = async ()=>{
        document.querySelector('#btn-create').style.visibility = null
        document.querySelector('#input form').remove()
    }

    const summitCreate = async ()=>{
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const value = document.querySelector('#input form #name').value

        const requestOptions = {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            method: "post",
            credentials: "same-origin",
            body: JSON.stringify({ name: value })
        };
        const response = await fetch('/api/categories/create', requestOptions);
        await get()
        document.querySelector('#btn-create').style.visibility = null
        document.querySelector('#input form').remove()
    }

    const deleteCategory = async ($id)=>{
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/api/categories/delete/${$id}`, { headers:{"X-CSRF-TOKEN": token} , method:"delete"} )
        await get()
    }

    const update = async ($id)=>{
        const getApi = await fetch(`/api/categories/${$id}`)
        const response = await getApi.json()
        const data = await response.data
        const html = `
            <form class="d-flex flex-row gap-1">
            @csrf
            <input id="name" type="text" class="form-control" placeholder="Name" value="${data.name}">
            <div class="btn btn-success" onclick="summitUpdate(${$id})">summit</div>
            <div class="btn btn-danger" onclick="cancel()">cancel</div>
            </form>
        `
        const reset = await document.querySelector('#input form')
        if(reset){
            reset.remove()
        }
        document.querySelector('#input').innerHTML = html
        document.querySelector('#btn-create').style.visibility = "hidden"
    }
    const summitUpdate = async($id)=>{
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const value = document.querySelector('#input form #name').value

        const requestOptions = {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            method: "put",
            credentials: "same-origin",
            body: JSON.stringify({ name: value })
        };
        const response = await fetch(`/api/categories/update/${$id}`, requestOptions);
        await get()
        document.querySelector('#btn-create').style.visibility = null
        document.querySelector('#input form').remove()
    }
    get()
</script>
@endsection
