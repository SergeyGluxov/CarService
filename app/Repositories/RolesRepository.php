<?php

namespace App\Repositories;

use App\Http\Resources\RolesResource;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesRepository
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function all()
    {
        RolesResource::withoutWrapping();
        return RolesResource::collection(Role::all());
    }

    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->get('name');
        $role->save();
        return response('Роль добавлена', 200);
    }

    public function find($id)
    {
        RolesResource::withoutWrapping();
        return new RolesResource(Role::find($id));
    }

    public function destroy($id)
    {
        DB::table('users_roles')->where('user_id', '=', $id)->delete();
        return response('Пользователь удален!', 200);
    }
}
