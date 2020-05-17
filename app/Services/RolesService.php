<?php

namespace App\Services;

use App\Repositories\RolesRepository;
use Illuminate\Http\Request;

class RolesService
{
    protected $rolesRepository;

    public function __construct(RolesRepository $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
    }

    public function all()
    {
        return $this->rolesRepository->all();
    }

    public function store(Request $request)
    {
        return $this->rolesRepository->store($request);
    }

    public function storeUserRole(Request $request)
    {
        return $this->rolesRepository->storeUserRole($request);
    }

    public function destroy($id)
    {
        return $this->rolesRepository->destroy($id);
    }
}
