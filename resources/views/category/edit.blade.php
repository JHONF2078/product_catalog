@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-sm-12">

            <h2>Edit Category : {{$category->name}}</h2>

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

    <form action="{{ route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" name="name" value="{{$category->name}}" class="form-control"
                    placeholder="write product name">
            </div>
            <div class="form-group col-md-6">
                <label>Parent</label>
                <select class="form-control" name="select_parent">
                    <option value="0000">choose ...</option>
                    @foreach($parents as $parent)
                    @if ($parent->code==$category->parentID)
                    <option value="{{$parent->code}}" selected="selected"> {{$parent->name}} </option>
                    @else
                    <option value="{{$parent->code}}">{{$parent->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">

            <div class="form-group col-md-6">
                <div>
                    <label>Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control-file">
                </div>
            </div>
            <div class="form-group col-md-6">
                <div>
                    <img id="img_photo" src="{{ URL::to('/') }}/images/{{$category->photo}} ">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-danger ">Cancel</button>
</div>

</form>

@endsection