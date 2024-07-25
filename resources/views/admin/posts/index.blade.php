@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-4">

            {{-- Intestazione --}}
            <div class="d-flex justify-content-between mb-3 align-items-center">
                <h1>Posts list</h1>
                <a  as='button' class="btn btn-primary" href="{{ route('admin.posts.create') }}">Create new post</a>
            </div>
            {{-- FINE Intestazione --}}

            {{-- Messaggio di conferma creazione nuovo post --}}
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            {{-- FINE Messaggio di conferma creazione nuovo post --}}

            {{-- Tabella --}}
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="col">#</th>
                    <th scope="col" class="col-2">USER</th>
                    <th scope="col" class="col-5">TITLE</th>
                    <th scope="col" class="col-3">SLUG</th>
                    <th scope="col" class="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td> {{ $post->user?->name ?: 'Capitan Tuta' }} </td>
                        <td> {{ $post->title }} @if ($post->cover_image)
                            - <i class="fas fa-image"></i> 
                        @endif</td>
                        <td>{{ $post->slug }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.posts.show', $post) }}" as='button' class="btn btn-info mx-1"><i class="fas fa-magnifying-glass"></i></a>
                                <a href="{{ route('admin.posts.edit', $post) }}" as='button' class="btn btn-warning ms-1 me-2"><i class="fas fa-pencil"></i></a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-can"></i></button>
                                </form>                             
                            </div>
                        </td>
                    </tr>
                    @endforeach
                  
                </tbody>
              </table>
              {{-- FINE Tabella --}}

        </div>
    </div>
</div>
    


@endsection