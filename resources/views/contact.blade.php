@extends('layouts/app')

@section('content')
    <div class="title">Contact Laravel 5</div>
    {{--@if(isset($people))--}}
        <ul>
            @foreach($people as $person)
                <li><b>{{$person}}</b></li>
            @endforeach
        </ul>
    {{--@endif--}}
@stop

@section('footer')
    {{--<script !src="">alert('hi visitor');</script>--}}
@stop