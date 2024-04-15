@extends('layouts.layout')

@section('content')
    <link rel="stylesheet" href='../../css/createFormulaire.css'>

    <h2>Modifier {{ $article->title}}</h2>
    <div class="container">
        <div class="form">
            <form action="{{ route('update', $article->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titre:</label>
                    <input class="form-control" type="text" name="title" id="title" value="{{ $article->title }}" required>
                </div>

                <div class="form-group">
                    <label for="author">Auteur:</label>
                    <input class="form-control" type="text" name="author" id="author" value="{{ $article->author }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description" id="description" rows="5" required>{{ $article->description }}</textarea>
                </div>

                <div class="button-group">
                    <button type="submit" id="form-button">Mettre à jour</button>
                    <a href="{{ route('show', $article->id) }}">
                        <button type="button" id="btn-cancel">Annuler</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

