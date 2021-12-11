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
            <p>@{{comments}}</p>
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
        </div>

        <div class="row">
            <div class="col">
                test
            </div>
        </div>
    </div>


    <br>
    <br>
    <br>
    <br>
    <br>

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
            mounted() {
                axios.get("{{ route('api.specific.post', ['post' => $post]) }}")
                .then( response => {
                    console.log("here");
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
    

    

@endsection