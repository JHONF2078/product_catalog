@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
    <h1 class="display-4">{{$product->name}}</h1>
    <p class="lead">Code: {{$product->code}}</p>
    <p class="lead">parent: {{$product->category_id}}</p>

    @foreach ($photos as $index=>$photo) 
         <img id="img_show_photo" src="{{ URL::to('/') }}/images/{{$photo->foto}} ">
    @endforeach
 
    </div>
  </div>
@endsection