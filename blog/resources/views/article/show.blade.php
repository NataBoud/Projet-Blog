@extends('layouts.layout')

@section('content')
    <link rel="stylesheet" href='../css/showArticle.css'>

    <div class="article">
        <div class="container">
            @if ($article)
            <h2>{{ $article->title }}</h2>
            <p>Auteur: {{ $article->user->name }}</p>
            <p>{{ $article->description }}</p>
            <span>Date de création: {{ $article->created_at }}</span>
            <hr>
            <span>Comments - nombre: {{count($article->comments)}}</span>

            {{--   commentaires sous l'article    --}}
            @auth

                <form action="{{route('comments.store', ['articleId' => $article->id])}}" method="POST">
                    @csrf
                    <textarea class="form-control" id="content" rows="5" required name="content" placeholder="Write a comment ...">
                        </textarea>

                    <button type="submit">Envoyer</button>
                </form>

            @endauth

            {{--    Affichage des commentaires sous l'article    --}}

                @if ($article && $article->comments)
                    @foreach($article->comments as $comment)
                        <div>
                            <p>{{$comment->user->name}} - {{$comment->created_at}}</p>
                            <p>{{$comment->content}}</p>
                        </div>
                    @endforeach
                @endif

            @else
                <p>Article introuvable</p>
            @endif

            {{--  BUTTONS  SUPPRIMER MODIFIER l'article    --}}
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
