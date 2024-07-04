<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function create()
    {
        $tags = Tag::all();
        return view('tags.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags',
        ]);

        Tag::create([
            'name' => $request->name,
        ]);

        return redirect()->route('home.index')->with('success', 'Tag created successfully.');
    }

}
