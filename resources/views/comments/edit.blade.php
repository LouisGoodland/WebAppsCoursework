@extends('layouts.posts')

@section('title')
    Edit comment
@endsection

@section('content')

    <form method="POST" action={{ route('update.comment', ['comment' => $comment]) }} enctype="multipart/form-data">
        @csrf
        <br>
        <p class="text-center">New Comment here:</p>
        <input type="text" name="content" class="position-relative top-50 start-50 translate-middle border border-2"
        value={{old('content')}}>
        <br>
        <br>
        <input type="submit" value="Submit" class="position-relative top-50 start-50 translate-middle">
    </form>     

    <form method="POST" action={{ route('destroy.comment', ['comment' => $comment]) }} enctype="multipart/form-data">
        @csrf
        <br>
        <p class="text-center">Or Delete Comment</p>
        <br>
        <input type="submit" value="Delete" class="button button-danger position-relative top-50 start-50 translate-middle">
    </form>   


@endsection