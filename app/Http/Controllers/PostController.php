<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => Post::latest()->paginate($request->per_page ?? 10),
        ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $notification
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest  $request)
    {



        $post =  Post::create($request->all());

        if ($post) {
            return response()->json([
                'message' => 'success',
                'status_code' => 200,
                'data' => $post,
            ]);
        }
        return response()->json(['message' => 'fail']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return response()->json([
            'message' => 'success',
            'status_code' => 200,
            'data' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StorePostRequest  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest  $request, Post $post)
    {
        $post->update($request->all());
        return response()->json([
            'message' => 'success',
            'status_code' => 200,
            'data' => $post,
        ]);
    }

    public function destroy(Post $post)
    {
        $postInfo = $post->delete();
        if ($postInfo) {
            return response()->json([
                'message' => 'success',
                'status_code' => 200,
                'data' => $postInfo,
            ]);
        }
        return response()->json(['message' => 'fail']);
    }
}
