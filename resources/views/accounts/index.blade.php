@extends('layouts.posts')

@section('title')
    test
@endsection

@section('content')
    @foreach ($collection as $item)
        <li>{{$item->username}}</li>
    @endforeach
@endsection