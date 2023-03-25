<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Support\Facades\Request;

class TypeController extends Controller
{

    public function index(Request $request)
	{
		return response()->json([
			'data' => Type::latest()->paginate($request->per_page ?? 10),
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
	 * @param  \App\Models\Type  $notification
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreTypeRequest  $request)
	{

		$typeInfo = new Type();

		$typeInfo->type_name = $request->type_name;
		$typeInfo->cat_id = $request->cat_id;

		if ($typeInfo->save()) {
			return response()->json([
				'message' => 'success',
				'status_code' => 200,
				'data' => $typeInfo,
			]);
		}
		return response()->json(['message' => 'fail']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Type  $Type
	 * @return \Illuminate\Http\Response
	 */
	public function show(Type $type)
	{

		return response()->json([
			'message' => 'success',
			'status_code' => 200,
			'data' => $type,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\StoreTypeRequest  $request
	 * @param  \App\Models\Type  $Type
	 * @return \Illuminate\Http\Response
	 */
	public function update(StoreTypeRequest  $request, Type $type)
	{



		$type->update($request->all());
		return response()->json([
			'message' => 'success',
			'status_code' => 200,
			'data' => $type,
		]);
	}

	public function destroy(Type $type)
	{


		$typeInfo = $type->delete();
		if ($typeInfo) {
			return response()->json([
				'message' => 'success',
				'status_code' => 200,
				'data' => $typeInfo,
			]);
		}
		return response()->json(['message' => 'fail']);
	}
}
