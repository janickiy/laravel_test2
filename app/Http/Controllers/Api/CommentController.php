<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Http\Requests\Api\Comment\StoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function add(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $class = Relation::getMorphedModel($data['commentable_type']);

        if (!$class) {
            throw new \Exception('Class not found');
        }

        $model = $class::find($data['commentable_id']);

        if (!$model) {
            throw new \Exception('Model not found');
        }

        $model->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $data['comment']
        ]);

        return response()->json(["status" => true, Response::HTTP_CREATED]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $comment = Comments::find($request->id);

        if (!$comment) {
            return response()->json([
                "error" => true,
                "message" => "Comment not found",
            ], Response::HTTP_NOT_FOUND);
        }

        if (auth()->user()->role !== 'admin') {
            if ($comment->user_id !== auth()->id()) {
                return response()->json([
                    "error" => true,
                ], Response::HTTP_FORBIDDEN);
            }
        }

        $comment->remove();
    }

}
