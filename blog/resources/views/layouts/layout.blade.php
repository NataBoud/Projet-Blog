<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="{{url('css/main.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<div id="container">

</div>

<header>
    <nav>
        <ul>
            @foreach(["accueil", "contact", "enregistrer", "se connecter" ] as $page)
                <li><a href="{{ route(strtolower($page)) }}">{{ $page }}</a></li>
            @endforeach
        </ul>
    </nav>

</header>

<main>
    @yield('content')
</main>

<footer>
    <p>Blog 2024</p>
</footer>
</body>
</html>
