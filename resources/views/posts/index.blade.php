@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if ( count($posts)>0 )
        @foreach ($posts as $post)
            <div class="well" style="margin-bottom: 25px; border: 1px solid lightgrey; padding: 5px;">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else    
        <p>No posts found</p>
        <div class="panel-body">
            <a href="/posts/create" class="btn btn-primary">Create a Post</a>                
        </div>
    @endif
@endsection