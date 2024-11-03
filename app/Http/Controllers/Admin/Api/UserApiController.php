<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService\UserService;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }
}
