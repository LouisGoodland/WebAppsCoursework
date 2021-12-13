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

        
        <div id="attributes">
            <div class="row">
                <div class="col">
                    <p class="text-center">Views: @{{ views }}</p>
                </div>  
                <div class="col">
                    <p class="text-center">Likes: @{{ likes }}</p>
                </div>  
                <div class="col">
                    <p class="text-center">Dislikes: @{{ dislikes }}</p>
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
        

            <div class="row">
                <div class="col">
                    @if(auth()->user()->account->id != $post->account_id)
                        <button @click="addLike" 
                        class="btn btn-success position-relative top-50 start-50 translate-middle">Like</button>
                    @endif
                </div>
                <div class="col">
                    @if(auth()->user()->account->id != $post->account_id)
                        <button @click="addDislike" 
                        class="btn btn-danger position-relative top-50 start-50 translate-middle">Dislike</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row" id="comments">
        <div class="row">
            <div class="row">
                <input type="text" id="input" v-model="content"
                 name="content" class="position-relative top-50 start-50 translate-middle border border-dark">
            </div>
            <div class="row">
                <button @click="addComment">Submit!</button>
            </div>
        </div>
        <div v-for="comment in comments" class="row border border-dark bg-secondary bg-opacity-10">

            <p class="text-center">@{{comment.account.username}} Commented:</p>
            <p class="text-center">@{{comment.content}}</p>


            <div v-if="comment.account_id == user_id">
                <button @click="editComment(comment)">Edit</button>
            </div>
            

        </div>
    </div>


    

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

    <script>
        var app = new Vue({
            el: "#attributes",
            data: {
                views: 0,
                likes: 0,
                dislikes: 0,
            },
            methods: {
                addLike: function(){
                    axios.post("{{ route('api.specific.post.like', ['post' => $post]) }}",
                    {})
                    .then(response => {
                        this.likes = response.data
                    })
                    .catch(response => {
                        console.log(response);
                    })
                },
                addDislike: function(){
                    axios.post("{{ route('api.specific.post.dislike', ['post' => $post]) }}",
                    {})
                    .then(response => {
                        console.log(response);
                        this.dislikes = response.data
                    })
                    .catch(response => {
                        console.log(response);
                    })
                }
            },
            mounted() {
                axios.get("{{ route('api.specific.post', ['post' => $post]) }}")
                .then( response => {
                    console.log(response);
                    this.views = response.data[0]
                    this.likes = response.data[1]
                    this.dislikes = response.data[2]
                })
                .catch(response => {
                    console.log(response);
                })
            },
        })
    </script>
    

    <script>
        var app = new Vue({
            el: "#comments",
            data: {
                comments: [],
                content: "",
                user_id: 0,
            },
            methods: {
                addComment: function(){
                    axios.post("{{ route('api.specific.post.create.comments', ['post' => $post]) }}",
                    {
                        content: this.content
                    })
                    .then(response => {
                        this.comments = response.data
                        this.content = ""
                    })
                    .catch(response => {
                        console.log(response);
                    })
                },
                editComment(comment){
                    console.log(comment['id']);
                    window.location = '/edit_comment/' + comment['id'];
                }
            },
            mounted() {
                axios.get("{{ route('api.specific.post.comments', ['post' => $post]) }}")
                .then( response => {
                    console.log(response);
                    this.comments = response.data[0]
                    this.user_id = response.data[1]
                })
                .catch(response => {
                    console.log(response);
                })
            },
        })
    </script>

    

@endsection