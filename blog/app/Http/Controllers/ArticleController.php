<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('article.create');
    }

    // CREATE
    public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
//        dd($request);
        $request->validate([
            'title' => 'required|string|min:2|max:255',
            'description' => 'required|string|',
        ]);

        Article::create([...$request->all(), 'user_id' => Auth::id(), 'author' => Auth::user()->name]);

        return redirect('/accueil');
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $articles = Article::all();
        return view('accueil', ['articles' => $articles]);
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

