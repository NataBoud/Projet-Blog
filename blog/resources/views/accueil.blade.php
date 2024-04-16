@extends('layouts.layout')

@section('content')
    <link rel="stylesheet" href='../css/welcome.css'>
    <link rel="stylesheet" href='../css/mainButton.css'>


        <h1>Bienvenue sur le Blog</h1>

@auth
        <a href="{{ route('create') }}" style="text-decoration: none;">
            <button class="btn-primary">Créer un article</button>
        </a>
            <div class="cards @if($articles->isEmpty()) no-articles @endif">
                @if($articles->isEmpty())
                    <h2>Vous n'avez pas d'articles</h2>
                @else

                    @foreach($articles as $article)
                        <div class="card">
                            <h3>{{ $article->title }}</h3>
                            <p>Auteur: {{$article->user->name}}</p>
                            <p class="desc">{{ $article->description }}</p>
                            <span>Date de création: {{ $article->created_at }}</span>
                            <div class="button">
                                <a id="btn-article" href="{{ route('show', $article->id) }}">
                                   Lire
                                </a>
                            </div>
                        </div>

                    @endforeach
                @endif
            </div>

@endauth

@endsection
