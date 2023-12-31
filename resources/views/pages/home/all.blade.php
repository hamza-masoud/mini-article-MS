@extends('layout.layout')

@section('title', 'article')

@section('content')
    <div class="container pt-5">
        <form action="{{ route('home') }}" method="get">
            <div class="input-group mb-3 w-50 mx-auto">
                <input type="text" class="form-control" placeholder="Search" name="search"
                       value="{{ request('search') }}"
                       aria-label="Search" aria-describedby="search">
                <button class="btn btn-outline-primary" type="submit" id="search">Search</button>
            </div>
        </form>

        @foreach($articles as $article)
            <div class="card my-3 shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h3>{{ $article->title }}</h3>
                        <span>{{ $article->comments_count }} comments • </span>
                        <span>{{ $article->published_at->diffForHumans() }}</span>
                    </div>
                    <button class="border p-2 rounded text-bg-light shadow-sm btn p-0" style="min-width: max-content"
                            onclick="window.location.href='{{ route('home') }}';">
                        <span class="me-2">{{ $article->user->full_name }}</span>
                        <img
                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                            alt="" class="rounded-circle" width="50">
                    </button>
                </div>
                <div class="card-body">
                    <p>{{ $article->content }}</p>
                    <div class="d-flex">
                        <a href="{{ route('home-article-show', $article) }}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        @endforeach
        {!! $articles->links() !!}

    </div>
@endsection
