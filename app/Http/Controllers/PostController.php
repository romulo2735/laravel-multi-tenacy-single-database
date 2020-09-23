<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\PostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();

        //* upload de imagens
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = Str::kebab($request->title);
            $ext = $request->image->extension();
            $file = "{$name}.$ext";
            $data['image'] = $file;

            $path = $request->image->storeAs('postagens', $file);
            if (!$path) {
                return redirect()->back()->with('erros', ['fail to upload']);
            }
        }

        //* pega o usuário logado, atribuido ao relacionamento de posts e cria a postagem.
        $request->user()->posts()->create($request->all());
        return redirect()->back()->withSuccess('Action Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $data = $request->all();

        //* upload de imagens
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // * remove a imagem caso exista, uma nova imagem enviada.
            if ($post->image) {
                if (Storage::exists("posts/{$post->image}")) {
                    Storage::delete("posts/{$post->image}");
                }
            }

            $name = Str::kebab($request->title);
            $ext = $request->image->extension();
            $file = "{$name}.$ext";
            $data['image'] = $file;

            $path = $request->image->storeAs('postagens', $file);
            if (!$path) {
                return redirect()->back()->with('erros', ['fail to upload']);
            }
        }

        $post->update($data);

        return redirect()->back()->withSuccess('Action Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();
        }

        $post->delete();

        return redirect()->back()->withSuccess('Action Successful');
    }
}
