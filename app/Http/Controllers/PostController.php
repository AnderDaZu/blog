<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        // pagiante() -> permite traer n cantidad de elementos
        $posts = Post::where('status', 2)->latest('id')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Post $post)
    {
        $similares = Post::where('category_id', $post->category_id)
                            ->where('status', 2)
                            ->where('id', '!=', $post->id)
                            ->latest('id')
                            ->take(4)
                            ->get();
        return view('posts.show', compact('post','similares'));
    }

    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
            ->where('status', 2)
            ->latest('id')
            ->paginate(6);
        return view('posts.category', compact('posts', 'category'));
    }

    public function tags(Tag $tag)
    {
        $posts = $tag->posts()->where('status', 2)->latest('id')->paginate(4);
        // $posts = Post::where('tag_id', $tag->id)
        //     ->where('status', 2)
        //     ->latest('id')
        //     ->paginate(6);
        // return view('posts.tag', compact('posts'));
        return view('posts.tag', compact('posts', 'tag'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
