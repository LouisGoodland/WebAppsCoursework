@extends('layouts.posts')

@section('title')
    Activity
@endsection

@section('content')
    
@section('navigation')

    <div class="col">
        <button class="btn btn-primary btn-lg w-100 p-2 border border-dark" type="button" data-bs-toggle="collapse"
         data-bs-target="#views" aria-expanded="false" aria-controls="views">
            Views
        </button>
    </div>

    <div class="col">
        <button class="btn btn-primary btn-lg w-100 p-2 border border-dark" type="button" data-bs-toggle="collapse"
         data-bs-target="#likes" aria-expanded="false" aria-controls="likes">
            Likes
        </button>
    </div>

    <div class="col">
        <button class="btn btn-primary btn-lg w-100 p-2 border border-dark" type="button" data-bs-toggle="collapse"
         data-bs-target="#dislikes" aria-expanded="false" aria-controls="dislikes">
            Dislikes
        </button>
    </div>

@endsection



    <h3 class="text-center">Views:</h3>
    <div class="row border border-2 border-dark bg-secondary bg-opacity-25">
        <div class="collapse" id="views">
            <div class="card card-body">
                    @foreach($views as $view)
                        <div class="row border border-dark bg-secondary bg-opacity-25">
                            <div class="col">
                                <p class="text-center">Post by: {{$view->post->account->username}}</p>
                            </div>
                            <div class="col">
                                <form method="GET" action=
                                {{ route('specific.post', ['post' => $posts->where('id', $view->post_id)->first()])}}>
                                    <input type="submit" value="Click here to view" 
                                    class="btn btn-dark border border-dark">
                                </form>
                            </div>
                        </div>
                    @endforeach   
            </div>
        </div>
    </div>

    <h3 class="text-center">Likes:</h3>
    <div class="row border border-2 border-dark bg-secondary bg-opacity-25">
        <div class="collapse" id="likes">
            <div class="card card-body">
                @foreach($likes as $like)
                    <div class="row border border-dark bg-secondary bg-opacity-25">
                        <div class="col">
                            <p class="text-center">Post by: {{$like->post->account->username}}</p>
                        </div>
                        <div class="col">
                            <form method="GET" action=
                            {{ route('specific.post', ['post' => $posts->where('id', $view->post_id)->first()])}}>
                                <input type="submit" value="Click here to view" 
                                class="btn btn-dark border border-dark">
                            </form>
                        </div>
                    </div>
                @endforeach   
            </div>
        </div>
    </div>

    <h3 class="text-center">Dislikes:</h3>
    <div class="row border border-2 border-dark bg-secondary bg-opacity-25">
        <div class="collapse" id="dislikes">
            <div class="card card-body">
                @foreach($dislikes as $dislike)
                    <div class="row border border-dark bg-secondary bg-opacity-25">
                        <div class="col">
                            <p class="text-center">Post by: {{$dislike->post->account->username}}</p>
                        </div>
                        <div class="col">
                            <form method="GET" action=
                            {{ route('specific.post', ['post' => $posts->where('id', $view->post_id)->first()])}}>
                                <input type="submit" value="Click here to view" 
                                class="btn btn-dark border border-dark">
                            </form>
                        </div>
                    </div>
                @endforeach   
            </div>
        </div>
    </div>
    

@endsection