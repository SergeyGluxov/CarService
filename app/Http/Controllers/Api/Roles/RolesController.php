<?php

namespace App\Http\Controllers\Api\Roles;

use App\Http\Controllers\Controller;
use App\Services\RolesService;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected $rolesService;

    public function __construct(RolesService $rolesService)
    {
        $this->rolesService = $rolesService;
    }

    public function index(Request $request)
    {
        return $this->rolesService->all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->rolesService->store($request);
    }

    public function storeUserRole(Request $request)
    {
        return $this->rolesService->storeUserRole($request);
    }

    public function show($id)
    {
        return $this->rolesService->find($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function deleteRole(Request $request)
    {
        return $this->rolesService->deleteRole($request);
    }

    public function destroy($id)
    {
        return $this->rolesService->destroy($id);
    }
}
