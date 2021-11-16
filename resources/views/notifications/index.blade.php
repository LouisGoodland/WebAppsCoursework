@extends('layouts.posts')

@section('title')   
    all notifications
@endsection

@section('content')
    @foreach ($notifications as $notification)
        <li><a href="/discover/{{$notification->id}}">{{$notification->id}}</a></li>
        <li>{{$notification->notification_text}}
        <br>
    @endforeach
@endsection