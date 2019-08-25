<?php

namespace App\Http\Controllers\Api\User;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaginateController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    public function __invoke(Request $request)
    {
        return $this->userService->all();
    }
}
