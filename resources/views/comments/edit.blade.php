@extends('layouts.posts')

@section('title')
    Edit comment
@endsection

@section('content')

    <form method="POST" action={{ route('update.post', ['post' => $post]) }} enctype="multipart/form-data">
        @csrf
        <br>
        <input type="text" name="content" class="position-relative top-50 start-50 translate-middle"
        value={{old('content')}}>
        <br>
        <br>
        <input type="submit" value="Submit" class="position-relative top-50 start-50 translate-middle">
    </form>     

@endsection