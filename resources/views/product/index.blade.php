@extends('layouts.app')

@section('content')


<div class="container">

    <h2>Products List  <a href="products/create" >   <button type="button" class="btn btn-success float-right">New Product</button></a></h2>

  
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">weight</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Actiones1</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td>{{$product->code}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->weight}}</td>
                <td>{{$product->price}}</td>
                <td>
                    {{$product->category_id}}</td>
                <td>
                    
                    <form action="{{route('products.destroy',$product->id)}}" method="POST">
                        <a href="{{route('products.show',$product->id)}}"><button type="button" class="btn btn-secondary">Ver</button></a> 
                        <a href="{{route('products.edit',$product->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>    
                     @csrf
                     @method('DELETE')                    
                     <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                    
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</div>

@endsection
