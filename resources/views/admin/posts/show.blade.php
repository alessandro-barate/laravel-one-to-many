@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col mt-4">

            {{-- Intestazione --}}
            <div class="mb-5">
                <h1>{{ $post->title }}</h1>
                <p>Created by: {{ $post->user?->name ?: 'Capitan Tuta' }}</p>
            </div>
            {{-- FINE Intestazione --}}

            {{-- Contenuto del post --}}
            <div class="mb-4">
                <p>{{ $post->content }}</p>
            </div>

            <div class="img-container">
                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="">
            </div>
            {{-- FINE Contenuto del post --}}

            <hr>

            Argomento: {{ $post->type?->title ?: 'Argomento non definito' }}

            <hr>

            <div class="mt-5">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Back to the posts list</a>
            </div>
        </div>
    </div>
</div>
    


@endsection