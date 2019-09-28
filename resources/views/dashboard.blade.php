@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <div class="panel-body">
                        <a href="/posts/create" class=" btn btn-primary">Create a Post</a>
                        <h3 style="margin: 25px 0 25px 0">Your Blog Posts</h3>
                        <table class="table table-class-stripped">
                            @if(count($posts) > 0)
                                <th>Title</th>
                                <th></th>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td><a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                                        <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                        <td>
                                            {!!Form::open(['action'  => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right' ] )!!}
                                                {!!Form::hidden('_method', 'DELETE')!!}
                                                {!!Form::submit('Delete', ['class' => 'btn btn-danger'])!!}
                                            {!!Form::close()!!}
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif(count($posts) === 0)
                                <p class="container">There is no posts from  {{ Auth::user()->name }} </p>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
