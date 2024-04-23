<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\UploadFile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('article.create');
    }

    // CREATE
    public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|min:2|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,jpg,png|max:2048'
        ]);

        $articleData = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'author' => Auth::user()->name,
            'user_id' => Auth::id(),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $originalName = $file->getClientOriginalName();

            $filePath = Storage::putFileAs('public/uploads', $file, $fileName);

            $uploadFile = UploadFile::create([
                'filename' => $fileName,
                'original_filename' => $originalName,
                'file_path' => $filePath,
            ]);

            $articleData['upload_file_id'] = $uploadFile->id;
        }

        Article::create($articleData);

        return redirect('/accueil');
   }

    public function index(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $articles = Article::with('uploadFile')->get();
        return view('accueil', ['articles' => $articles]);
    }

    // READE ARTICLE PAR ID

    public function show($id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|View|\Illuminate\Contracts\Foundation\Application
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
        ]);

        $article = Article::find($id);
        $article->update($request->all());

        return redirect('/article/' . $id)->with('success', 'Article mis à jour avec succès');
    }

    // DELETE ARTICLE PAR ID

    public function destroy($id): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $article = Article::findOrFail($id);
        $file = UploadFile::findOrFail($article->upload_file_id);

        Storage::delete($file->file_path);

        $article->delete();
        $file->delete();

        return redirect('/accueil')->with('success', 'Article supprimé avec succès');
    }

    public function edit($id): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $article = Article::find($id);
        return view('article.edit')->with('article', $article);
    }

}

