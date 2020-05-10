<?php

namespace App\Repositories;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        UserResource::withoutWrapping();
        return UserResource::collection(User::all());
    }

    public function getWorkers()
    {
        $workers = User::whereHas(
            'roles', function ($q) {
            $q->where('name', '!=', null);
        }
        )->get();
        UserResource::withoutWrapping();
        return UserResource::collection($workers);
    }

    public function find($id)
    {
        UserResource::withoutWrapping();
        return new UserResource(User::where('id', $id)->firstOrFail());
    }

    public function store(Request $request)
    {
        $userStore = new User();
        $userStore->name = $request->get('name');
        $userStore->email = $request->get('email');
        $userStore->password = $request->get('password');
        $userStore->save();
        return response('Пользователь успешно добавлен!', 200);
    }

    public function destroy($id)
    {
        $userDestroy = User::findOrFail($id);
        if ($userDestroy->delete())
            return response('Пользователь удален!', 200);
    }
}
