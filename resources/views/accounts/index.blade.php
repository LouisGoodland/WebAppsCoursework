@extends('layouts.posts')

@section('title')
    test
@endsection

@section('content')
    @foreach ($collection as $item)
        <li><a href="/discover_accounts/{{$item->id}}">{{$item->username}}</a></li>
    @endforeach
@endsection