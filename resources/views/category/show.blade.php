@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
    <h1 class="display-4">{{$category->name}}</h1>
    <p class="lead">Code: {{$category->code}}</p>
    <p class="lead">parent: {{$category->parentID}}</p>
    <img id="img_show_photo" src="{{ URL::to('/') }}/images/{{$category->photo}} ">
    </div>
  </div>
@endsection