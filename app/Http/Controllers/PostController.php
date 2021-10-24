<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate();
        //$posts = Post::all();
        return view('admin.posts.index', [
            'posts' => $posts,
        //return view('admin.posts.index', compact('posts'));
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        //$request = new Request;
        //dd($request->all());
        Post::create($request->all());
            //[
            //'title' => $request->title
        //]);
        return redirect()
                    ->route('posts.index')
                    ->with('message', 'Post criado com sucesso');
    }

    public function show($id)
    {
        // $post = Post::where('id', $id)->first();
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('posts.index');
        }

        return view('admin.posts.show', compact('post'));
    }

    public function destroy($id)
    {
        if (!$post = Post::find($id)) 
            return redirect()->route('posts.index');
        $post->delete();
        return redirect()
                ->route('posts.index')
                ->with('message', 'Post Deletado com sucesso');        
    }

    public function edit($id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->back();
        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreUpdatePost $request, $id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->back();
        }

        $post->update($request->all());

        return redirect()
                ->route('posts.index')
                ->with('message', 'Post atualizado com sucesso');
    }
}
