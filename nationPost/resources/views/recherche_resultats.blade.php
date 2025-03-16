@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Résultats de Recherche</h1>

    @if($articles->isEmpty())
        <p class="text-center">Aucun résultat trouvé.</p>
    @else
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('media/' . $article->image_art) }}" class="card-img-top" alt="Image de {{ $article->title_art }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title_art }}</h5>
                            <p class="card-text"><strong>Catégorie :</strong> {{ $categories->firstWhere('id_cat', $article->fk_category_art)->name_cat ?? 'Non défini' }}</p>
                            <p class="card-text"><strong>Date :</strong> {{ $article->date_art }}</p>
                            <p class="card-text">{{ Str::limit($article->hook_art, 100) }}</p>
                            <a href="{{ route('article.show', ['id' => $article->id_art]) }}" class="btn btn-primary">Lire plus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Ajout du script Bootstrap pour s'assurer que le menu fonctionne correctement --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
@endsection
