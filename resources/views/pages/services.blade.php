@extends('layouts.app')

@section('content')
        
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit vel voluptatem accusamus praesentium eaque nulla nobis adipisci, ipsum magnam tempora. Eum dolor corrupti vel vero facilis, veritatis esse fugiat repudiandae.</p>
        <p>{ { $services } }</p>
        
        @if (count($services) > 0)
            <ul class='list-group'>
                @foreach($services  as $service)
                    <li class='list-group-item'> { { $service } } </li>
                @endforeach
            </ul>
        @endif
@endsection