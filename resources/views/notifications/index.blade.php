@extends('layouts.posts')

@section('title')   
    all notifications
@endsection

@section('content')
    @foreach ($notifications as $notification)
        <li>{{$notification->notification_text}}
        <br>
    @endforeach
@endsection