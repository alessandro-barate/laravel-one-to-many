@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-4">

            {{-- Intestazione --}}
            <div class="d-flex justify-content-between mb-3 align-items-center">
                <h1>Create your post</h1>
            </div>
            {{-- FINE Intestazione --}}

            {{-- Gestione errori --}}
            @include('shared.errors')
            {{-- FINE Gestione errori --}}

            {{-- Form --}}
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="post-title" class="form-label">Post title</label>
                    <input type="text" class="form-control" id="post-title" name="title">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Post content</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" cols="100" name="content"></textarea>
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Cover image</label>
                    <input class="form-control" type="file" id="cover_image" name="cover_image">
                </div>

                <button type="submit" class="btn btn-primary">Create post</button>
            </form>
            {{-- FINE Form --}}

            <hr>

            {{-- Bottone all'index --}}
            <div class="mt-5">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Back to the posts list</a>
            </div>
            {{-- FINE Bottone all'index --}}

        </div>
    </div>
</div>
@endsection