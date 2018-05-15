<?php

use App\Models\Category;
use App\Models\Note;
use Illuminate\Http\Request;

Route::get('/notes', function() {
	$notes = Note::with('category')
		->get()
		->toArray();

	return response()->json($notes);
});

Route::patch('/notes/{id}/edit', function($id, Request $request) {
	
	try {
		$note = Note::findOrFail($id);
	} catch (\Exception $e) {
		return response()->json('Model not found', 404);
	}

    $title = $request->input('title', 'note title');
    $content = $request->input('content', 'note content');

    $category_id = null;

    if($request->has('category')) {
    	$category = Category::find($request->category);
    
    	if(!empty($category)) {
    		$category_id = $category->id;
    	}
    }

    $note->title = empty($title) ? 'note title' : $title;
    $note->content = empty($content) ? 'note content' : $content;
    $note->category_id = $category_id;

	$note->save();

	return response()->json($note);
});

Route::delete('/notes/{id}/delete', function($id, Request $request) {
	
	try {
		$note = Note::findOrFail($id);
	} catch (\Exception $e) {
		return response()->json('Model not found', 404);
	}

	$note->delete();

	return response()->json('success');
});

Route::post('categories', function(Request $request) {
    $category = new Category;

    $title = $request->input('title', 'category title');

    $category->title = empty($title) ? 'category title' : $title;

    $category->save();

    return response()->json($category);
});

























/*Route::get('/notes', 'NoteController@index')->name('note-list');

Route::post('/notes', 'NoteController@create')->name('note-create');

Route::patch('/notes/{id}/edit', 'NoteController@edit')->name('note-edit');

Route::delete('/notes/{id}/delete', 'NoteController@delete')->name('note-delete');

Route::post('categories', 'CategoryController@create')->name('category-create');*/