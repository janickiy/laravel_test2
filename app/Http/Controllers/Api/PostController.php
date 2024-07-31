<?php

namespace App\Http\Controllers\Api;

use App\Models\Posts;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\ListRequest;
use App\Http\Requests\Api\Post\StoreRequest;
use App\Http\Requests\Api\Post\EditRequest;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['list']]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getPost(int $id): JsonResponse
    {
        $post = Posts::find($id);

        if (!$post) {
            return response()->json([
                "status" => true,
                "message" => "Post not found",
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json(Arr::except($post->toArray(), ['created_at', 'updated_at']));
    }

    /**
     * @param ListRequest $request
     * @return JsonResponse
     */
    public function list(ListRequest $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 40);
        $page = ($page - 1) * $limit;

        $posts = Posts::query();
        $count = $posts->count();

        $items = Posts::map($posts->limit($limit)->offset($page)->get());

        return response()->json(['items' => $items, 'count' => $count]);
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        Posts::create(array_merge($request->all(),['user_id' => auth()->id()]));

        return response()->json(["status" => true, Response::HTTP_CREATED]);
    }

    /**
     * @param EditRequest $request
     * @return JsonResponse
     */
    public function update(EditRequest $request): JsonResponse
    {
        $post = Posts::find($request->id);

        if (!$post) {
            return response()->json([
                "error" => true,
                "message" => "Post not found",
            ], Response::HTTP_NOT_FOUND);
        }

        if (auth()->user()->role !== 'admin') {
            if ($post->user_id !== auth()->id()) {
                return response()->json([
                    "error" => true,
                ], Response::HTTP_FORBIDDEN);
            }
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return response()->json(["status" => true]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $post = Posts::find($request->id);

        if (!$post) {
            return response()->json([
                "error" => true,
                "message" => "Post not found",
            ], Response::HTTP_NOT_FOUND);
        }

        if (auth()->user()->role !== 'admin') {
            if ($post->user_id !== auth()->id()) {
                return response()->json([
                    "error" => true,
                ], Response::HTTP_FORBIDDEN);
            }
        }

        $post->remove();
    }
}
