@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-sm-6">

            <h2>Create new Category</h2>

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

    <form action="/categories" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label>Code</label>
                <input type="text" name="code" class="form-control" placeholder="write category code">
            </div>
            <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="write category name">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Parent</label>
                <select class="form-control" name="select_parent">  
                    <option value="0000" >choose ...</option>                
                    @foreach($parents as $parent)
                   <option value="{{$parent->code}}">{{$parent->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <div>
                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control-file">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
        <button type="reset" class="btn btn-danger ">Cancel</button>
</div>

</form>

@endsection