@extends('layouts.posts')

@section('title')
    specific post
@endsection

@section('content')
    <li>{{$accounts->where('id', $post->account_id)->first()->username}} posted:</li>
    <li>{{$post->content}}</li>
    <li>Views: {{$post->views}} Likes: {{$post->likes}} Dislikes: {{$post->dislikes}}</li>

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

    @if ($post->image_path != null)
        <img src="{{ asset('images/'.$post->image_path) }}"/>
    @endif

    @foreach ($comments as $comment)
        <li>{{$accounts->where('id', $comment->account_id)->first()->username}} commented:</a></li>
        <li>{{$comment->content}}</li>
        <br>
    @endforeach

    @if (auth()->user()->account->is_admin)
        <form method="POST" action={{ route('destroy.post', ['post' => $post]) }}>
            @csrf
            <input type="submit" value="Silence as admin!">
        </form>
    @elseif (auth()->user()->account->id == $post->account_id)
        <form method="POST" action={{ route('destroy.post', ['post' => $post]) }}>
            @csrf
            <input type="submit" value="Delete post">
        </form>
    @endif

    <li><a href={{ route('discover.posts') }}>Back</a></li>
@endsection