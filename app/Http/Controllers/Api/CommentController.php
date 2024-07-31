<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['list']]);
    }

    public function list(Request $request)
    {

    }

    public function info(int $id)
    {

    }

    public function add()
    {

    }

    public function edit()
    {

    }
    public function delete()
    {

    }

}
