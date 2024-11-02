<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;


class AdminControl extends Controller
{
    public function addTag(Request $request)
    {
        // Validate request
        $request->validate([
            'tagName' => 'required',
        ]);

        // Create and return the new tag
        return Tag::create([
            'tagName' => $request->tagName,
        ]);
    }
    public function getTag()
    {
        return response()->json(Tag::orderBy('created_at', 'desc')->get());
    }

    public function editTag(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'tagName' => 'required|string|max:255',
            'id' => 'required|exists:tags,id',
        ]);

        // Update the tag name
        $tag = Tag::where('id', $validatedData['id'])->update([
            'tagName' => $validatedData['tagName'],
        ]);

        if ($tag) {
            return response()->json(['message' => 'Tag updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Tag update failed'], 500);
        }
    }
   

    
}
