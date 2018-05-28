<?php

Route::group(['prefix' => 'notes'], function() {
	Route::get('/', 'NoteController@index')->name('note-list');

	Route::post('/', 'NoteController@create')->name('note-create');

	Route::group(['prefix' => '{note}','middleware' => 'note_exists'], function() {
		Route::patch('edit', 'NoteController@edit')->name('note-edit');

		Route::delete('delete', 'NoteController@delete')->name('note-delete');
	});

});

Route::post('categories', 'CategoryController@create')->name('category-create');