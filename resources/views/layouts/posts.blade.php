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
        <div class="col border border-dark">

            <a href= {{ route("discover.accounts") }}>
                <input type="submit" value="Accounts" class="btn btn-secondary btn-lg w-100 p-2 dropdown-toggle">
            </a>

        </div>
        <div class="col border border-dark">


            <a href= {{ route("discover.posts") }}>
                <input type="submit" value="Posts" class="btn btn-secondary btn-lg w-100 p-2">
            </a>


        </div>  
        <div class="col border border-dark">
            <a href= {{ route("create.post") }}>
                <input type="submit" value="Create a post" class="btn btn-secondary btn-lg w-100 p-2">
            </a>
        </div> 
        <div class="col border border-dark">
            <a href= {{ route("my.account") }}>
                <input type="submit" value="My Account" class="btn btn-secondary btn-lg w-100 p-2">
            </a>
        </div> 
        <div class="col border border-dark">
            <a href= {{ route("notifications") }}>
                <input type="submit" value="Notifications" class="btn btn-secondary btn-lg w-100 p-2">
            </a>
        </div> 
    </div>
    
    
    
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
         data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div>

    <div>
        @yield('content')
    </div>

</body>




</html>
