<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content"width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>


<body>
    <h1>@yield('title')</h1>
    
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif

    <a href= {{ route("discover.accounts") }}><input type="submit" value="Accounts" ></a>
    <a href= {{ route("discover.posts") }}><input type="submit" value="Posts"></a>
    <a href= {{ route("create.post") }}><input type="submit" value="Create a post"></a>
    <a href= {{ route("my.account") }}><input type="submit" value="My Account"></a>
    <a href= {{ route("notifications") }}><input type="submit" value="Notifications"></a>

    <div>
        @yield('navigation')
    </div>
    

    <div>
        @yield('content')
    </div>

</body>




</html>
