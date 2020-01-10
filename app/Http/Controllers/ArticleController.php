<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreArticle;
use App\Article;

class ArticleController extends Controller
{
  public function index(Request $request)
  {
    $status = $request->session()->get('status');
    $articles = Article::paginate(2);
    return view('article.index', compact('articles', 'status'));
  }

  public function show($id)
  {
    $article = Article::findOrFail($id);
    return view('article.show', compact('article'));
  }

  // Вывод формы
  public function create()
  {
    // Передаём в шаблон вновь созданный объект. Он нужен для вывода формы через Form::model
    $article = new Article();
    return view('article.create', compact('article'));
  }

  public function store(StoreArticle $request)
  {
    $validatedData = $request->validated();

    $article = new Article();
    // Заполнение статьи данными из формы
    $article->fill($validatedData);
    // При ошибках сохранения возникнет исключение
    $article->save();

    $request->session()->flash('status', 'Store article was successful!');

    // Редирект на указанный маршрут с добавлением флеш-сообщения
    return redirect()
      ->route('articles.index');
  }

  public function edit($id)
  {
    $article = Article::findOrFail($id);
    return view('article.edit', compact('article'));
  }

  public function update(Request $request, $id)
  {
      $article = Article::findOrFail($id);
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

  public function destroy(Request $request, $id)
  {
      // DELETE — идемпотентный метод, поэтому результат операции всегда один и тот же
      $article = Article::find($id);
      if ($article) {
        $article->delete();
      }

      $request->session()->flash('status', 'Delete article was successful!');

      return redirect()->route('articles.index');
  }
}
