@extends('layouts.posts')

@section('title')
    test
@endsection

@section('content')
    @foreach ($collection as $item)
        <li><a href="/specialroute/{{$item->id}}">{{$item->account_id}}</a></li>
    @endforeach
@endsection