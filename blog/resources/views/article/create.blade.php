@extends('layouts.layout')

@section('content')
    <link rel="stylesheet" href='../css/createFormulaire.css'>

    <h2>Création d'article</h2>
    <div class="container">
        <div class="form">
            <form method="POST" action="{{ route('create') }}">
                @csrf

                    <div class="form-group">
                        <label for="title">Titre de l'article</label>
                        <input id="title" type="text" name="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="author">Auteur</label>
                        <input id="author" type="text" name="author" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>

                    <div class="button-group">
                        <button type="submit" id="form-button">Publier</button>
                    </div>

            </form>
        </div>
    </div>
@endsection
