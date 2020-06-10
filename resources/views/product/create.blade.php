@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-sm-6">

            <h2>Create new Product</h2>

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

    <form action="/products" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label>Code</label>
                <input type="text" name="code" class="form-control" placeholder="write product code">
            </div>
            <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="write product name">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Description</label>
                <input type="text" name="description" class="form-control" placeholder="write description name">
            </div>
            <div class="form-group col-md-6">
                <label>Weight</label>
                <input type="text" name="weight" class="form-control" placeholder="write weight name">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Price</label>
                <input type="text" name="price"id="price" onkeyup="format(this)" class="form-control " placeholder="write price name">
            </div>
            <div class="form-group col-md-6">
                <label>USD</label>
                 <input type="text" name="usd" id="usd" class="form-control" value="" placeholder="write price USD" disabled>
                 <input name="usd_value" id="usd_value" type="hidden" value="{{$dolar_value}}">
                </div>
        </div>

        <div class="row">          
            <div class="form-group col-md-6">
                <label>category</label>
                <select class="form-control" name="select_category">
                    <option value="0000">choose ...</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="row">
            <div class="form-group col-md-6">
                <div>
                    <label>Photo 1</label>
                    <input type="file" name="photo_product_1" class="photo_product form-control-file"  >
                    <br>
                    <textarea rows="4", cols="54"  name="photo_product_1_description" style="resize:none, "></textarea>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div>
                    <img id="img_photo_product_1" src="{{ URL::to('/') }}/images/vacio.png">
                </div>
            </div>        
        </div>
        
        <div class="row">
            <div class="form-group col-md-6">
                <div>
                    <label>Photo 2</label>
                    <input type="file" name="photo_product_2" class="photo_product form-control-file" >
                    <br>
                    <textarea rows="4", cols="54"  name="photo_product_2_description" style="resize:none, "></textarea>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div>
                    <img id="img_photo_product_2" src="{{ URL::to('/') }}/images/vacio.png">
                </div>
            </div>        
        </div>
        
        <div class="row">
            <div class="form-group col-md-6">
                <div>
                    <label>Photo 3</label>
                    <input type="file" name="photo_product_3" class="photo_product form-control-file">
                    <br>
                    <textarea rows="4", cols="54"  name="photo_product_3_description" style="resize:none, "></textarea>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div>
                    <img id="img_photo_product_3" src="{{ URL::to('/') }}/images/vacio.png">
                </div>
            </div>        
        </div>     

        <button type="submit" class="btn btn-primary">Register</button>
        <button type="reset" class="btn btn-danger ">Cancel</button>
</div>

</form>

@endsection