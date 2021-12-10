@extends('layouts.posts')

@section('title')
    edit account
@endsection

@section('content')
    <form method="POST" action={{ route('update.account') }} enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-5">
                <p class="text-center">Profile picture:</p>
            </div>
            <div class="col-7">
                <input type="file"  name="image">
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <p class="text-center">First name:</p>
            </div>
            <div class="col-7">
                <input type="text" name="first_name" value="{{ old('first_name') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <p class="text-center">Last name:</p>
            </div>
            <div class="col-7">
                <input type="text" name="last_name" value="{{ old('last_name') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <p class="text-center">Date of Birth:</p>
            </div>
            <div class="col-7">
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
            </div>
        </div>
        <br>
        <br>
        
        <input type="submit" value="Submit" class="position-relative top-50 start-50 translate-middle">

    </form>
@endsection