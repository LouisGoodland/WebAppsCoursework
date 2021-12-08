<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content"width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">
</head>


<body>
    <h1 class="text-center w-100 p-3 border" style="background-color: #eee;">
        Loustergram
    </span></h1>
   
    
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif


    <div class="container mw-100 row p-3 mb-2 bg-secondary text-white">
        <div class="col">

            @if(Route::currentRouteName()=="discover.accounts")
                <a href= {{ route("discover.accounts") }}>
                    <input type="submit" value="Accounts" class="btn btn-dark btn-lg w-100 p-2">
                </a>
            @else
                <a href= {{ route("discover.accounts") }}>
                    <input type="submit" value="Accounts" class="btn btn-light btn-lg w-100 p-2">
                </a>
            @endif

        </div>
        <div class="col">

            @if(Route::currentRouteName()=="discover.posts")
                <a href= {{ route("discover.posts") }}>
                    <input type="submit" value="Posts" class="btn btn-dark btn-lg w-100 p-2">
                </a>
            @else
                <a href= {{ route("discover.posts") }}>
                    <input type="submit" value="Posts" class="btn btn-light btn-lg w-100 p-2">
                </a>
            @endif

        </div>  
        <div class="col">

            @if(Route::currentRouteName()=="create.post")
                <a href= {{ route("create.post") }}>
                    <input type="submit" value="Create Post" class="btn btn-dark btn-lg w-100 p-2">
                </a>
            @else
                <a href= {{ route("create.post") }}>
                    <input type="submit" value="Create Post" class="btn btn-light btn-lg w-100 p-2">
                </a>
            @endif

        </div> 
        <div class="col">

            @if(Route::currentRouteName()=="my.account")
                <a href= {{ route("my.account") }}>
                    <input type="submit" value="My Account" class="btn btn-dark btn-lg w-100 p-2">
                </a>
            @else
                <a href= {{ route("my.account") }}>
                    <input type="submit" value="My Account" class="btn btn-light btn-lg w-100 p-2">
                </a>
            @endif

        </div> 


        <div class="col">

            @if(Route::currentRouteName()=="notifications")
                <a href= {{ route("notifications") }}>
                    <input type="submit" value="Notifications" class="btn btn-dark btn-lg w-100 p-2">
                </a>
            @else
                <a href= {{ route("notifications") }}>
                    <input type="submit" value="Notifications" class="btn btn-light btn-lg w-100 p-2">
                </a>
            @endif
        </div> 


    </div>


    <div class="container">
        <div class="navbar navbar-expand-lg navbar-light bg-light">
            @yield("navigation")
        </div>
    </div>





    <div>
        @yield('content')
    </div>

</body>


</html>
