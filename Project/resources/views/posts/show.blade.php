@extends('layouts.master')
@section('title','Show Post')
@section('content')
<div class="container-fluid mb-5">
    <div class="row text-center">
        <div class="mb-4">
    <h5 class="card-title">{{$post->title}}</h5>
        </div>
        <div class="card mb-4 ">
            <a href="#!"><img class="card-img-top" src="{{ asset($post->image_path) }}" alt="..." /></a>
        </div>
        <div class="col-md-6">
                <div class="card-body">
                    <p class="card-text">{{$post->content}}</p>
            </div>
        </div>
    </div>
</div>
@endsection