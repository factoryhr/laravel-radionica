<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct(Category $category)
    {
    	$this->category = $category;
    }

    public function create(CreateCategoryRequest $request)
    {
	    $this->category->title = $request->title;

	    $this->category->save();

	    return response()->json($this->category);
    }
}
