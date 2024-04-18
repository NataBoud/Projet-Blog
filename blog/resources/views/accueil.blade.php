@extends('layouts.layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mainButton.css') }}">

    <h1>Bienvenue sur le Blog</h1>

    @auth
        <a href="{{ route('create') }}" style="text-decoration: none;">
            <button class="btn-primary">Créer un article</button>
        </a>

        <div class="cards {{ empty($articles) ? 'no-articles' : '' }}">
            @empty($articles)
                <h2>Vous n'avez pas d'articles</h2>
            @else
                @foreach($articles as $article)
                    <div class="card">
                        @if($article->uploadFile)
                            <img src="{{ Storage::url($article->uploadFile->file_path) }}" alt="image-article">
                        @endif

                        <h3>{{ $article->title }}</h3>
                        <p>Auteur: {{ $article->user->name }}</p>
                        <p class="desc">{{ $article->description }}</p>
                        <span>Date de création: {{ $article->created_at }}</span>
                        <p>Comments: {{ count($article->comments) }}</p>
                        <div class="button">
                            <a id="btn-article" href="{{ route('show', $article->id) }}">Lire</a>
                        </div>
                    </div>
                @endforeach
            @endempty
        </div>
    @endauth
@endsection
