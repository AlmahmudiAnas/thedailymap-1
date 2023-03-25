<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Request;


class CategoryController extends Controller
{
    public function index(Request $request)
	{
		return response()->json([
			'data' => Category::latest()->paginate($request->per_page ?? 10),
		]);
	}

	// /**
	//  * Show the form for creating a new resource.
	//  *
	//  * @return \Illuminate\Http\Response
	//  */
	// public function create()
	// {
	//     //
	// }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Category  $notification
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreCategoryRequest  $request)
	{

		$categoryInfo = new Category();

		$categoryInfo->category_name = $request->category_name;

		if ($categoryInfo->save()) {
			return response()->json([
				'message' => 'success',
				'status_code' => 200,
				'data' => $categoryInfo,
			]);
		}
		return response()->json(['message' => 'fail']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function show(Category $category)
	{

		return response()->json([
			'message' => 'success',
			'status_code' => 200,
			'data' => $category,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\CategoryReuest  $request
	 * @param  \App\Models\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function update(StoreCategoryRequest  $request, Category $category)
	{



		$category->update($request->all());
		return response()->json([
			'message' => 'success',
			'status_code' => 200,
			'data' => $category,
		]);
	}

	public function destroy(Category $category)
	{


		$categoryInfo = $category->delete();
		if ($categoryInfo) {
			return response()->json([
				'message' => 'success',
				'status_code' => 200,
				'data' => $categoryInfo,
			]);
		}
		return response()->json(['message' => 'fail']);
	}
	 
}
