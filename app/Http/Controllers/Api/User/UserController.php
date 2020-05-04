<?php

namespace App\Http\Controllers\Api\User;


use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    public function __construct(UserService $user)
    {
        $this->user=$user;
    }

    public function index(Request $request)
    {
        return $this->user->all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->user->store($request);

    }

    public function show($id)
    {
        return $this->user->find($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        return $this->user->destroy($id);
    }
}
