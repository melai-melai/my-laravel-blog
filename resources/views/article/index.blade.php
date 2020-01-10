@extends('layouts.app')

@section('title', 'Articles')

@section('content')
		@if (isset($status))
		    <div>
		        {{ $status }}
		    </div>
		@endif
		<hr>
    <small><a href="{{ route('articles.create') }}">Create new article</a></small>
    <br>
    <h1>List of articles</h1>
    @foreach ($articles as $article)
        <a href="{{ route('articles.show', $article) }}">{{$article->name}}</a>
        <a href="{{ route('articles.edit', $article) }}">Edit article</a>
        <a href="{{ route('articles.destroy', $article) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow">Delete</a>
        <div>{{Str::limit($article->body, 5)}}</div>
    @endforeach
    {{ $articles->links() }}
@endsection