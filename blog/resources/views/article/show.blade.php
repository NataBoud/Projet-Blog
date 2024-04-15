@extends('layouts.layout')

@section('content')
    <link rel="stylesheet" href='../css/showArticle.css'>

    <div class="article">
        <div class="container">
            <h2>{{ $article->title }}</h2>
            <p>Auteur: {{ $article->author }}</p>
            <p>{{ $article->description }}</p>
            <span>Date de création: {{ $article->created_at }}</span>
            <div class="button-group">
                <a href="{{ route('edit', $article->id) }}">
                    <button id="btn-edit">Modifier</button>
                </a>
                <form action="{{ route('destroy', $article->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="btn-delete" type="submit" >Supprimer</button>
                </form>
            </div>
        </div>
    </div>

@endsection
