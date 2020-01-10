<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticle;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->session()->get('status');
        $articles = Article::paginate(2);
        return view('article.index', compact('articles', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article = new Article();
        return view('article.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\StoreArticle  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        $validatedData = $request->validated();
        $article = new Article();
        $article->fill($validatedData);
        $article->save();
        $request->session()->flash('status', 'Store article was successful!');
        return redirect()
          ->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
          // У обновления немного изменённая валидация. В проверку уникальности добавляется название поля и id текущего объекта
          // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
          'name' => 'required|unique:articles,name,' . $article->id,
          'body' => 'required|min:5',
        ]);
        $article->fill($request->all());
        $article->save();
        $request->session()->flash('status', 'Edit article was successful!');
        return redirect()
          ->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Article $article)
    {
        if ($article) {
            $article->delete();
        }
        $request->session()->flash('status', 'Delete article was successful!');
        return redirect()->route('articles.index');
    }
}
