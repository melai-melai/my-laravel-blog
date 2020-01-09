@extends('layouts.app')

@section('title', 'Articles')

@section('content')
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <a href="{{ route('articles.show', $article) }}">{{$article->name}}</a>
        <div>{{Str::limit($article->body, 5)}}</div>
    @endforeach
    {{ $articles->links() }}
@endsection