@extends('layouts.posts')

@section('title')
    {{$post->account->username}}
@endsection

@section('content')

    <div class="row border border-dark bg-secondary bg-opacity-25">
        <div class="row">
            <p class="text-center fs-3">{{$post->account->username}}:</p>
        </div>
        @if ($post->image_path != null)
            <div class="row">
                <img src="{{ asset('images/'.$post->image_path) }}"/>
            </div>
        @endif
        <div class="row">
            <p class="text-center">{{$post->content}}</p>
        </div>
        <div class="row" id="data">
            <div class="col">
                <p class="text-center">Views: {{$post->views}}</p>
            </div>  
            <div class="col">
                <p class="text-center">Likes: {{$post->likes}}</p>
            </div>  
            <div class="col">
                <p class="text-center">Dislikes: {{$post->dislikes}}</p>
            </div> 
            <div class="col">
                <p class="text-center">Comments: {{$comments->count()}}</p>
            </div>   
        </div>
        <div class="row">
            <div class="col">
                @if (auth()->user()->account->is_admin)
                    <form method="POST" action={{ route('destroy.post', ['post' => $post]) }}>
                        @csrf
                        <input type="submit" value="Silence as admin!" class="btn btn-danger btn-lg w-100 p-2 border border-dark">
                    </form>
                @elseif (auth()->user()->account->id == $post->account_id)
                    <form method="POST" action={{ route('destroy.post', ['post' => $post]) }}>
                        @csrf
                        <input type="submit" value="Delete post" class="btn btn-danger btn-lg w-100 p-2 border border-dark">
                    </form>
                @endif
            </div>
            <div class="col">
                @if (auth()->user()->account->id == $post->account_id)
                    <form method="GET" action={{ route('edit.post', ['post' => $post]) }}>
                        @csrf
                        <input type="submit" value="Edit post" class="btn btn-primary btn-lg w-100 p-2 border border-dark">
                    </form>
                @endif
            </div>

        </div>
    </div>


    @if(auth()->user()->account->id != $post->account_id)
        <form method="POST" action={{ route('post.add_like', ['post' => $post->id]) }}>
            @csrf
            <input type="submit" value="like">
        </form>
        
        <form method="POST" action={{ route('post.add_dislike', ['post' => $post->id]) }}>
            @csrf
            <input type="submit" value="dislike">
        </form>
    @endif
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <div id="root">
        <p>@{{ message }}</p>
        <li>@{{ comments }}
        <li v-for="comment in comments">@{{ comment }}</li>

        <p>Comment: <input type="text" id="input" v-model="newCommentContent"></p>
        <button @click="createComment">Create</button>
    </div>

    <script>
        var app = new Vue({
            el: "#root",
            data: {
                comments: [],
                message: "It Works",
                newCommentContent: '',
            },
            methods: {
                createComment: function(){
                    axios.post("{{ route('api.comment.post', ['post' => $post]) }}",
                    {
                        name: this.newCommentContent
                    })
                    .then(response => {
                        this.comments.push(response.data);
                        this.newCommentContent = ""
                    })
                    .catch(response => {
                        console.log(response);
                    })
                }
            },
            mounted() {
                axios.get("{{ route('api.specific.post', ['post' => $post]) }}")
                .then( response => {
                    console.log("here");
                    this.comments = response.data
                })
                .catch(response => {
                    console.log("hereeeee");
                    console.log(response);
                })
            },
        })
    </script>

@endsection