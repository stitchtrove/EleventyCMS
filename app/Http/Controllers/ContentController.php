<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Post;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{

    public function list()
    {
        $collections = Collection::with('posts')->get();
        return view('content', compact('collections'));
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        // $safecontent = nl2br(html_entity_decode($post->content));
        $safecontent = $post->content;
        return view('edit', compact(['post', 'safecontent']));
    }

    public function save(Request $request)
    {
        $post = Post::where('id', $request->post_id)->firstOrFail();
        $post->update(['content' => $request->newContent]);
        return redirect('/content');
    }
}
