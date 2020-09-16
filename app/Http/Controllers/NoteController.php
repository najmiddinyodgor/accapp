<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NoteController extends Controller
{
    public function create()
    {
        return Inertia::render("Note/Create", [
            'sessions' => session()->all(),
            'categories' => Category::all(),
            'subCategories' => SubCategory::select('id', 'name')->where('category_id', 1)->get()
        ]);
    }

    public function edit($id)
    {
        $note = Note::find($id);
        $note->subCategory->category;
        return Inertia::render('Note/Edit', [
            'sessions' => session()->all(),
            'note' => $note,
            'categories' => Category::all(),
            'subCategories' => SubCategory::select('id', 'name')->where('category_id', 1)->get()
        ]);
    }

    public function store(NoteRequest $request)
    {
        Note::insert([
            'user_id' => Auth::id(),
            'sub_category_id' => $request->subCategory,
            'amount' => $request->amount,
            'comment' => $request->comment,
            'date' => $request->date
        ]);

        return redirect()->back();
    }

    public function update(NoteRequest $request, $id)
    {
        $category = SubCategory::find($request->subCategory)->category->id;
        Note::find($id)->update([
            'sub_category_id' => $request->subCategory,
            'amount' => $request->amount,
            'comment' => $request->comment,
            'date' => $request->date
        ]);

        return redirect()->route('categories', $category);
    }

    public function delete($id)
    {
        Note::destroy($id);
        return redirect()->back();
    }
}