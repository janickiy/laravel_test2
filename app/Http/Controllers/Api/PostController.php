<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
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
