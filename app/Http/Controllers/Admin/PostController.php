<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::all();
    

        return view('admin.posts.index', compact('posts'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // Validazione dei dati
        $data = $request->validated();

        // Gestione immagine
        $img_path = null;
        if(isset($data['cover_image'])) {
            $img_path = Storage::put('uploads', $data['cover_image']);
        }

        // Gestione slug
        $slug = Str::of($data['title'])->slug('-');
        $data['slug'] = $slug;

        // Creo nuovo Post
        $post = new Post();

        // Assegno valori
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->slug = $data['slug'];
        $post->cover_image = $img_path;

        $post->save();

        return redirect()->route('admin.posts.index')->with('message', 'Post correctly created - Post #'. $post->id);
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $slug)
    public function show(Post $post)
    {
    //    $post = Post::where('slug', $slug)->first();

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit' , compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        // TODO: Nell'upload, non mi sostituisce l'immagine

        // Validazione dei dati
        $data = $request->validated();

        // Gestione slug
        $data['slug'] = Str::of($data['title'])->slug();

        // Gestione immagine
        if(isset($data['cover_image'])) {

            // Cancello l'immagine se gia presente
            if ($post->cover_image) {
                Storage::delete($post->cover_image);      
            }

            // Salvo la nuova immagine
            $img_path = Storage::put('uploads', $data['cover_image']);
            $post->cover_image = $img_path;
        }

        // Assegno valori
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->slug = $data['slug'];

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('message', 'Post #' . $post->id . ' correctly updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Cancello immagine se presente nel post
        if($post->cover_image){
            Storage::delete($post->cover_image);
        }

        $post_id = $post->id;

        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', 'Post #' . $post_id . ' correctly deleted');

    }
}
