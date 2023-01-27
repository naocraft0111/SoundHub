<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();

        $tagRecords = $tag->articles()->orderBy('created_at', 'desc')->paginate(10);

        return view('tags.show', compact('tag','tagRecords'));
    }
}
