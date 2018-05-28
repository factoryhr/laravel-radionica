<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertNoteRequest;
use App\Models\Category;
use App\Models\Note;

class NoteController extends Controller
{
	public function __construct(Note $note, Category $category)
	{
		$this->note = $note;
		$this->category = $category;
	}

    public function index()
    {
    	$notes = $this->note
    		->with('category')
			->get()
			->toArray();

		return response()->json($notes);
    }

    public function create(UpsertNoteRequest $request)
    {
	    $this->note->title = $request->title;
	    $this->note->content = $request->content;
	    $this->note->category_id = $request->category_id;

		$this->note->save();

		return response()->json($this->note);
    }

    public function edit(Note $note, UpsertNoteRequest $request)
    {
	    $note->title = $request->title;
	    $note->content = $request->content;
	    $note->category_id = $request->category_id;

		$note->save();

		return response()->json($note);
    }

    public function delete(Note $note)
    {
		$note->delete();

		return response()->json('success');
    }
}
