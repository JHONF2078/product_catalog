@extends('layouts.app')

@section('content')


<div class="container">

    <h2>Categories List  <a href="categories/create" >   <button type="button" class="btn btn-success float-right">New Category</button></a></h2>

  
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Photo</th>
                <th scope="col">Parent Category</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->code}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->photo}}</td>
                <td>
                    {{$category->parentID}}</td>
                <td>
                    
                    <form action="{{route('categories.destroy',$category->id)}}" method="POST">
                        <a href="{{route('categories.show',$category->id)}}"><button type="button" class="btn btn-secondary">Ver</button></a> 
                        <a href="{{route('categories.edit',$category->id)}}"><button type="button" class="btn btn-primary">Edit</button></a>    
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