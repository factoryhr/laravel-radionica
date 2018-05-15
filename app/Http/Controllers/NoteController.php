<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertNoteRequest;
use App\Models\Category;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
	public function __construct(Note $note, Category $category)
	{
		$this->note = $note;
		$this->category = $category;

		//$this->middleware('note_exists')->only('edit', 'delete');
	}

    public function index()
    {
    	$notes = $this->note
    		->with('category')
			->get()
			->toArray();

		return response()->json($notes);
    }

    public function create(Request $request)
    {
    	/*$validator = Validator::make($request->all(), [
	        'title' => 'required|string|max:25',
	        'content' => 'required|string|max:100',
	        'category_id' => 'nullable|exists:categories.id',
	    ]);

	    if ($validator->fails()) {

          return response()->json(['errors'=>$validator->errors()]);
        }*/

	    $title = $request->input('title', 'note title');
	    $content = $request->input('content', 'note content');

	    $category_id = null;

	    if($request->has('category')) {
	    	$category = $this->category->find($request->category);
	    
	    	if(!empty($category)) {
	    		$category_id = $category->id;
	    	}
	    }

	    $this->note->title = empty($title) ? 'note title' : $title;
	    $this->note->content = empty($content) ? 'note content' : $content;
	    $this->note->category_id = $category_id;

		$this->note->save();

		return response()->json($this->note);
    }

    public function edit($id, Request $request)
    {
    	try {
			$note = $this->note->findOrFail($id);
		} catch (\Exception $e) {
			return response()->json('Model not found', 404);
		}

    	/*$validator = Validator::make($request->all(), [
	        'title' => 'required|string|max:25',
	        'content' => 'required|string|max:100',
	        'category_id' => 'nullable|exists:categories.id',
	    ]);

	    if ($validator->fails()) {

          return response()->json(['errors'=>$validator->errors()]);
        }*/

	    $title = $request->input('title', 'note title');
	    $content = $request->input('content', 'note content');

	    $category_id = null;

	    if($request->has('category')) {
	    	$category = $this->category->find($request->category);
	    
	    	if(!empty($category)) {
	    		$category_id = $category->id;
	    	}
	    }

	    $note->title = empty($title) ? 'note title' : $title;
	    $note->content = empty($content) ? 'note content' : $content;
	    $note->category_id = $category_id;

		$note->save();

		return response()->json($note);
    }

    public function delete($id)
    {
		try {
			$note = $this->note->findOrFail($id);
		} catch (\Exception $e) {
			return response()->json('Model not found', 404);
		}

		$note->delete();

		return response()->json('success');
    }
}
