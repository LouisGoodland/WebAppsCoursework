@extends('layouts.posts')

@section('title')
    {{$name}} enclosure
@endsection

@section('content')
    @if($name=="test")
        passed!
    @else
        else
    @endif
@endsection