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
            <li><a href="{{route('accueil')}}">Accueil</a></li>
            <li><a href="{{route('contact')}}">Contacter</a></li>
            @auth
                <li><a href="{{route('create')}}">Créer article</a></li>
            @endauth

            @guest
                <li><a href="{{route('login')}}">Se connecter</a></li>
                <li><a href="{{route('register')}}">S'enregistrer</a></li>
            @endguest

            @auth
                <li>{{auth()->user()->name}}</li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button>Déconnexion</button>
                    </form>
                </li>
            @endauth
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
