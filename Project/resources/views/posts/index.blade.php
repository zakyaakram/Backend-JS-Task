@extends('layouts.master')
@section('title', 'Show Posts')
@section('content')
<div class="row">
    @foreach ($posts as $post)
        <div class="col-6">
            <!-- Blog post-->
            <div class="card mb-4 ">
                <a href="#!"><img class="card-img-top" src="{{ asset($post->image_path) }}"
                        alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">{{ $post->created_at->diffforhumans() }}</div>
                    <h2 class="card-title h4">{{ $post->title }}</h2>
                    <p class="card-text">{{ substr($post->content, 0, 20) }} </br> <small> created by :
                            {{ $post->user->name }} </small></p>
                            @if(count($post->categories) > 0)
                            @foreach ($post->categories as $category)
                            <span class="badge bg-secondary text-white mb-2">{{ $category->name }}</span>

                            @endforeach
                            @endif
                            </br>
                    <div class="row-4">
                        <a class="btn btn-sm btn-primary" href="{{ route('posts.edit', $post->id) }}"> Edit </a>
                        <a class="btn btn-sm btn-primary" href="{{ route('posts.show', $post->id) }}"> Read More </a>
                        <a class="btn btn-danger" href="#"
                        onclick="event.preventDefault();
                document.getElementById('delete-post-{{ $post->id }}').submit();">Delete</a>
                    <form id="delete-post-{{ $post->id }}"
                        action="{{ route('posts.destroy', $post->id) }}" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
    </div>
    {{-- {{ $posts->links('layouts.components.Pagination') }} --}}
@endsection
