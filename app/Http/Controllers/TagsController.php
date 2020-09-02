<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use phpDocumentor\Reflection\Types\Array_;

class TagsController extends Controller
{

    public function index()
    {
        $allTags = Tag::all();

        return view('admin.tags',['tags' => $allTags]);
    }

    public function tagsjson()
    {
        $allTags = Tag::all();

        foreach ($allTags as $i => $tag) {
            $data[$i]['id'] = $tag->id;
            $data[$i]['name'] = $tag->name;
        }
        return $data;
    }

    public function create()
    {
        return view('admin.tags_form',['tag' => new Tag()]);
    }

    public function edit(int $id)
    {
        return view('admin.tags_form',['tag' => Tag::findOrFail($id)]);
    }

    public function show($id)
    {
        return Tag::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());

        return $tag;
    }

    public function store(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)) {
            $tag = new Tag();
        } else {
            $tag = Tag::findOrFail($id);
        }

        $tag->name = $request->input('name');
        $tag->slug = $request->input('slug');
        $tag->save();
        return redirect(route('tags.index'));
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect(route('tags.index'));
    }
}
