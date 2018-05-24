<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use App\Rules\TitleRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct(Category $category)
    {
    	$this->category = $category;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:25'],
        ]);

        if ($validator->fails()) {

          return response()->json(['errors'=>$validator->errors()]);
        }

	    $title = $request->input('title', 'category title');

	    $this->category->title = empty($title) ? 'category title' : $title;

	    $this->category->save();

	    return response()->json($this->category);
    }
}
