<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
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

        // $posts = Post::where('user_id', Auth::user()->id)->get(); ---> questo per avere in pagina principale
        // solo i post creati dall'utente loggato

        return view('admin.posts.index', compact('posts'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.posts.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // Validazione dei dati
        $data = $request->validated();

        $current_user = Auth::user()->id;

        // Gestione immagine
        $img_path = $request->hasFile('cover_image') ? Storage::put('uploads', $data['cover_image']) : NULL;
        

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
        $post->type_id = $data['type_id'];
        $post->user_id = $current_user;

        // $post->type_id = $request->input('type_id');

        ;

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
        $types = Type::all();

        return view('admin.posts.edit' , compact('post', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        // TODO: Non mi visualizza più l'immagine; se faccio un upload ad un record con immagine, mi viene tolta

        // Validazione dei dati
        $data = $request->validated();

        // Gestione slug
        $data['slug'] = Str::of($data['title'])->slug();

        // Gestione immagine
        $img_path = $request->hasFile('cover_image') ? $request->cover_image->store('uploads') : NULL;

        // Assegno valori
        // $post->title = $data['title'];
        // $post->content = $data['content'];
        // $post->slug = $data['slug'];
        // $post->type_id = $data['type_id'];
        

        $post->update($data);

        $post->cover_image = $img_path;
        $post->save();

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
