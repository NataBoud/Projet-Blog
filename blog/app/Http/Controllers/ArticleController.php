<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('article.create');
    }


    // CREATE
    public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|min:2|max:255',
            'description' => 'required|string|',
            'author' => 'required|string|min:2|max:255'
        ]);

        Article::create($request->all());

        return redirect('/accueil');
    }

    public function index()
    {
        $articles = Article::all();
        return view('welcome')->with('articles', $articles);
    }

    // READE ARTICLE PAR ID

    public function show($id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $article = Article::find($id);
        return view('article.show')->with('article', $article);
    }

    // UPDATE ARTICLE PAR ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|min:2|max:255',
            'description' => 'required|string',
            'author' => 'required|string|min:2|max:255'
        ]);

        $article = Article::find($id);
        $article->update($request->all());

        return redirect('/article/' . $id)->with('success', 'Article mis à jour avec succès');
    }

    // DELETE ARTICLE PAR ID

    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return redirect('/accueil')->with('error', 'Article non trouvé');
        }

        $article->delete();

        return redirect('/accueil')->with('success', 'Article supprimé avec succès');
    }

    public function edit($id)
    {
        $article = Article::find($id);
        return view('article.edit')->with('article', $article);
    }

}

