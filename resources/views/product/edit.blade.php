@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-sm-6">

            <h2>Edit Product</h2>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
    <form action="{{ route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="form-group col-md-6">
                <label>Code</label>
                <input type="text" name="code" value="{{$product->code}}" class="form-control"
                    placeholder="write product code">
            </div>
            <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" name="name" value="{{$product->name}}" class="form-control"
                    placeholder="write product name">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Description</label>
                <input type="text" name="description" value="{{$product->description}}" class="form-control"
                    placeholder="write description name">
            </div>
            <div class="form-group col-md-6">
                <label>Weight</label>
                <input type="text" name="weight" value="{{$product->weight}}" class="form-control"
                    placeholder="write weight name">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Price</label>
                <input type="text" name="price" value="{{$product->price}}" class="form-control "
                    placeholder="write price name">
            </div>
            <div class="form-group col-md-6">
                <label>Category</label>
                <select class="form-control" name="select_category">
                    <option value="0000">choose ...</option>
                    @foreach($categories as $category)
                    @if ($category->id==$product->category_id)
                    <option value="{{$category->id}}" selected="selected"> {{$category->name}} </option>
                    @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>

     
       @foreach ($photos as $index=>$photo)    
      
        <div class="row">
            <div class="form-group col-md-6">
                <div>
                    <label>Photo {{$index+1}}</label>
                    <input type="file" name="photo_product_{{$index+1}}" class="photo_product form-control-file">
                    <br>
                    <textarea rows="4" , cols="54" name="photo_product_{{$index+1}}_description" 
                        style="resize:none, ">{{$photo->description}}</textarea>
                   <input name="photo_id_{{$index+1}}" type="hidden" value="{{$photo->id}}">
                </div>
            </div>
            <div class="form-group col-md-6">
                <div>
                <img id="img_photo_product_{{$index+1}}" src="{{ URL::to('/') }}/images/{{$photo->foto}}">
                </div>
            </div>
        </div>
        @endforeach


        <button type="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-danger ">Cancel</button>
</div>

</form>

@endsection