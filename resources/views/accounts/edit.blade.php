@extends('layouts.posts')

@section('title')
    edit account
@endsection

@section('content')
    <form method="POST" action={{ route('update.account') }} enctype="multipart/form-data">
        @csrf
        <input type="file"  name="image">
        <p>First name: <input type="text" name="first_name"
        value="{{ old('first_name') }}"></p>
        <p>Last name: <input type="text" name="last_name"
        value="{{ old('last_name') }}"></p>
        <p>Date of Birth: <input type="date" name="date_of_birth"
        value="{{ old('date_of_birth') }}"></p>
        
        <input type="submit" value="Submit">
    </form>
@endsection