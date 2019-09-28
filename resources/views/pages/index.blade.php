@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Welcome to Laravel</h1>
        <h1>{{$title}}</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit vel voluptatem accusamus praesentium eaque nulla nobis adipisci, ipsum magnam tempora. Eum dolor corrupti vel vero facilis, veritatis esse fugiat repudiandae.</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a><a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    </div>
@endsection