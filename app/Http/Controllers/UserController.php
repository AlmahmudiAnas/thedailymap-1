<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		return User::orderBy('id', 'DESC')->paginate($request->per_pgae ?? 10);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
	//	$roles = Role::pluck('name', 'name')->all();
		return response()->json([
			'message' => 'success',
			'status_code' => 200,
			'data' => $roles,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(UserRequest $request) {
		$input = $request->all();
		$input['password'] = Hash::make($input['password']);

		$user = User::create($input);
		$user->assignRole($request->input('roles') ?? []);
		$user->assignPermissions($request->input('permissions') ?? []);

		return response()->json([
			'message' => 'success',
			'status_code' => 200,
			'data' => $user,
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user) {
		return response()->json([
			'message' => 'success',
			'status_code' => 200,
			'data' => array_merge($user->toArray(), [
				'permissions' => $user->getAllPermissions(),
				'roles' => $user->roles,
			]),
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UserRequest $request, User $user) {
		$input = $request->all();
		$user->update($input);
		// DB::table('model_has_roles')
		// 	->where('model_id', $user->id)
		// 	->delete();
		// $user->syncRoles($request->input('roles') ?? []);
		$user->syncPermissions($request->input('permissions') ?? []);

		return response()->json([
			'message' => 'success',
			'status_code' => 200,
		]);
	}
	public function destroy(User $user) {
		$user->delete();
		return response(['message' => 'success', 'data' => $user], 200);
	}

	public function restore(User $user) {
		$user->delete();
		return response(
			['message' => 'success', 'data' => $user->withTrashed()->restore()],
			200
		);
	}
}
