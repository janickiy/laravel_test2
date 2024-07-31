<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Like\LikeRequest;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param LikeRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function like(LikeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $class = Relation::getMorphedModel($data['likeable_type']);

        if (!$class) {
            throw new \Exception('Class not found');
        }

        $model = $class::find($data['likeable_id']);

        if (!$model) {
            throw new \Exception('Model not found');
        }

        $likes = $model->likes()->where('user_id', auth()->id());

        if ($likes->count() > 0) {
            $likes->delete();
        } else {
            $model->likes()->create([
                'user_id' => auth()->id(),
            ]);
        }

        return response()->json(["status" => true, Response::HTTP_CREATED]);
    }
}
