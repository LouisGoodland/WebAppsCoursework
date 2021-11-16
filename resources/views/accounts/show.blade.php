@extends('layouts.posts')

@section('title')
    test
@endsection

@section('content')
    <li>{{$account->username}}</li>
    <li>{{$account->first_name}}</li>
    <li>{{$account->last_name}}</li>
@endsection