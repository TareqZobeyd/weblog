<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the weblog view.
     *
     * @return View
     */
    public function index()
    {
        $posts = Post::all();
        return view('home.index', compact('posts'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('home.create', compact('tags'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }
        $userId = Auth::id();

        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'text' => $request->text,
            'user_id' => $userId,
        ]);

        // Attach tags to the post
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('home.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
//        dd($post);
        $post->load('user');

        if ($post->user_id !== Auth::id()) {
            // Debugging information
            Log::debug('User ID mismatch', [
                'post_id' => $post->id,
                'post_user_id' => $post->user_id,
                'authenticated_user_id' => Auth::id()
            ]);

            abort(403);
        }
        $tags = Tag::all();

        return view('home.edit', compact('post', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        // Sync tags for the post
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach(); // Remove all tags if none selected
        }

        return redirect()->route('home.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('home.index')->with('success', 'Post deleted successfully.');
    }

}

