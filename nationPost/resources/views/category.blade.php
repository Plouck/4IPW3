@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->name_cat }}</h1>
    <p>Liste des articles de la catégorie {{ $category->name_cat }} :</p>

    <div class="list-group">
        @foreach ($articles as $article)
            <a href="{{ route('article.show', $article->id_art) }}" class="list-group-item list-group-item-action">
                <h5>{{ $article->title_art }}</h5>
                <p>{{ Str::limit($article->hook_art, 100) }}</p>
            </a>
        @endforeach
    </div>
</div>
@endsection
