<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function like()
    {

    }
}
